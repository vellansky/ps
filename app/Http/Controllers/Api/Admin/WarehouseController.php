<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Warehouse\Warehouse_products;
use App\Models\Global\Images;
use App\Models\Product\Price;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use App\Models\Admin\Warehouse\Warehouse;

class WarehouseController extends Controller
{

    public function warehouseItemsEdit(Request $r){
        $arr = $r->toArray();
        foreach ($arr as $product)
            Product::where('id', $product['id'])->update([
                'code' => $product['code'],
                'name' => $product['name'],
        ]);
            $text = [
                "title" => 'Товары обновленны',
                "body" => ''
            ];
           return response($text, 200);
    }


    public function warehouseItemsList(Request $r)
    {
        $items = Warehouse::find($r->id)->items;
        return response($items, 200);
    }
    public function warehouseCreate(Request $r)
    {
        $arr = $r->toArray();
        $warehouse = Warehouse::Create(
            [
                'admin_id' => 1,
                'name' => $arr['name']['value'],
                'country' => $arr['country']['value'],
                'city' => $arr['city']['value'],
                'street' => $arr['street']['value'],
                'house_number' => $arr['houseNumber']['value'],
                'telephone' => $arr['telephone']['value'],
            ]);
        $text = [
            "title" => 'Склад создан',
            "body" => 'Теперь добавьте товары на свой склад' . ' ' . $warehouse->name
        ];
        return response($text, 200);
    }

    public function warehouseItemsImport(Request $r)
    {
        $arr = $r->toArray();

        $productOk = [];

        $warehouseId = $arr['warehouseId'];
        foreach ($arr['items'] as $product) {

            if(empty($product['Товар']) || empty($product['ШК товара']) ) {
                continue;
            } else {

                $productRow = Product::updateOrCreate([
                    'code' => $product['ШК товара'],
                ],
                    [
                        'status' => $product['Статус'] ?? true,
                        'code' => $product['ШК товара'],
                        'name' => $product['Товар'],
                        'description' => $product['Описание'] ?? null,
                    ]);

                $image = Images::firstOrNew([
                    'imageable_id' => $productRow->id,
                ],

                    [
                        'name' => 'Нет фото',
                        'url' => '/img/ifEmty.webp',
                        'imageable_id' => $productRow->id,
                        'imageable_type' => 'product',
                    ]);
                $image->save();

                $price = Price::firstOrNew([
                    'product_id' => $productRow->id,
                ],

                    [
                        'product_id' => $productRow->id,
                        'price' => $product['Розничная цена'] ?? 0,
                        'new_price' => null,
                    ]);
                $price->save();

                $warehouse = Warehouse_products::firstOrNew([
                    'warehouse_id' => $warehouseId,
                    'product_id' => $productRow->id,
                ],

                    [
                        'warehouse_id' => $warehouseId,
                        'product_id' => $productRow->id,
                        'quantity' => $product['Кол-во (отклонение)'] ?? 0,
                    ]);
                $warehouse->save();

                array_push($productOk, $productRow);
            }

        }
        $count = count($productOk);
        $text = [
            "title" => "Товары добавлены успешно!",
            "body" => 'Товары в количестве' . ' ' . $count . ' ' .'шт. были добавлены на склад'
        ];
        return response($text, 200);
    }
    public function getWarehouses()
    {
        $warehouses = Warehouse::get();
        return response($warehouses, 200);
    }

    public function getWarehouseItems(Request $req)
    {
        $data = Warehouse::find($req->id)->items()->withPivot('quantity')->get();
        return response($data, 200);
    }
}
