<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Global\Images;
use App\Models\Product\Price;
use App\Models\Product\Stock;
use App\Models\Admin\Warehouse\Warehouse_products;
use App\Models\CategoryProducts;
use function MongoDB\BSON\toJSON;

class ProductController extends Controller
{

    public function fromWarehouse(Request $r)
    {
        $arr = $r->toArray();
        foreach ($arr as $product) {
            Stock::updateOrCreate([
                'product_id' => $product['id'],
                'shop_id' => 1,
            ],
            [
                'product_id' => 1,
                'shop_id' => 1,
                'quantity' => 1,
            ]);
        }
        $text = [
            "title" => "Товары добавлены успешно!",
            "body" => 'Да'
        ];
        return response($text, 200);
    }
    public function getProducts()
    {
        return Product::get();
    }
    public function getProductId(Request $r)
    {
        $product = Product::where('id', $r->productId)->with('price', 'images')->first();
        return response($product, 200);
    }
    public function productEditStatus (Request $r)
    {
        Product::where("id", $r->id)->update([
            'status' => $r->status,
        ]);
        $product = Product::where('id', $r->id)->select('name', 'status')->first();
        $name = $product->name;
        if($product->status === 0) {
            $stext = 'скрыт от покупателей';
        } else {
            $stext = 'снова доступен покупателям';
        }
        $data = [
            "text" => [
            "title" => "Товар изменил свой статус",
            "body" => 'Товар' . ' ' . $name . ' ' . $stext
                ],
            "status" => $product->status
        ];
        return response($data, 200);
    }
    public function editProduct(Request $r)
    {
        Product::where("id", $r->id)->update([
            'status' => $r->status ?? 1,
            'code' => $r->code,
            'name' => $r->name,
            'description' => $r->description
        ]);

        //$test = array_key_exists('status', $arr['categories']);

            foreach ($r['categories'] as $categories){
                $verify = array_key_exists('status', $categories);
                if (array_key_exists('status', $categories)) {
                    if($categories['status'] === 'del'){
                        CategoryProducts::where([
                            'products_id' => $r['id'],
                            'category_id' => $categories['id'],
                        ])->delete();
                    }
                    if($categories['status'] === 'add') {
                        CategoryProducts::firstOrCreate([
                            'products_id' => $r['id'],
                            'category_id' => $categories['id'],
                        ]);
                    }
                }

        }
        return response(null, 200);
    }

    public function editImage(Request $req)
    {
        if( $req->hasFile('file')){

        $filenameWithExt = $req->file('file')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extention = $req->file('file')->getClientOriginalExtension();
        $save = Storage::disk('public')->put('/', $req->file('file'));

        $url = Storage::disk('public')->url($save);



         Images::updateOrCreate([
                    'imageable_id' => $req->product,
                    'imageable_type' => 'product'
                ],
                [
                    'name' => $filenameWithExt,
                    'url' => $url,
                    'imageable_id' => $req->product,
                    'imageable_type' => 'product'
                ]);
        }
            $product = Product::where('id', $req->product)->select('name')->first();
            $data = [
                'text' => [
                    "title" => "Изображение обновлено!",
                    "body" => 'Изображение товара' ." " . $product->name . " " . 'обновлено',
                ],
                'image' => [
                    "id" => $req->product,
                    "name" => $filenameWithExt,
                    "url" => $url,
                ],
            ];
            return response($data, 200);
        }

    public function importProducts(Request $req)
    {
        $arr = $req->toArray();
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
                            //'price' => $product['Розничная цена'] ?? 0,
                            //'quantity' => $product['Кол-во (отклонение)'] ?? 0,
                            'description' => $product['Описание'] ?? null,
                            //'slug' => Str::slug($product['Товар'] .' '. $product['ШК товара'], '-')
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
}
