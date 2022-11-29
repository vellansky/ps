<?php

namespace App\Http\Controllers\Api\Admin\items;

use App\Http\Controllers\Controller;
use App\Models\Admin\Warehouse\Warehouse_products;
use App\Models\Global\City;
use App\Models\Global\Images;
use App\Models\Global\Slug;
use App\Models\Global\Items;
use App\Models\Product\Price;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use App\Models\Admin\Shop;
use Illuminate\Support\Str;

class itemsController extends Controller
{


    public function itemsList()
    {
        $product = Product::with('images', 'categories')->get();
        return response($product, 200);
    }


    //получить город
    public function getCity($r){
        $city = Shop::select('city')->find($r)->city;
        $cityId = City::where('name', $city)->select('id')->first()->id;
        return $cityId;
    }

    public function itemsUpdateInfo(Request $r)
    {
        $items = $r->toArray();
        $cityId = $this->getCity($r->shopId);
        foreach ($r->items as $item) {
            Items::updateOrCreate(
                [
                    'city_id' => $cityId,
                    'shop_id' => $item['pivot']['shop_id'],
                    'product_id' => $item['pivot']['product_id'],
                ],
                [
                    'quantity' => $item['pivot']['quantity'],
                    'price' => $item['pivot']['price'],
                    'new_price' => $item['pivot']['new_price'],
                ]
            );
        }
        return response($r, 200);
    }


    public function itemsCreateList(Request $r)
    {
        $city = Shop::select('city')->find($r->shopId)->city;
        $cityId = City::where('name', $city)->select('id')->first()->id;




        $productOk = [];
        foreach ($r->items as $product) {
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
                    'imageable_type' => 'product',
                ],

                    [
                        'name' => 'Нет фото',
                        'url' => '/img/ifEmty.webp',
                        'imageable_id' => $productRow->id,
                        'imageable_type' => 'product',
                    ]);
                $image->save();

                $slug = Slug::firstOrNew([
                    'essence_id' => $productRow->id,
                    'essence_type' => 'product',
                ],

                    [
                        'slug' => Str::slug($product['Товар'], '-'),
                        'essence_id' => $productRow->id,
                        'essence_type' => 'product',
                    ]);
                $slug->save();


                array_push($productOk, $productRow);
            }

        }


        $newArr = [];
        foreach ($r->items as $item) {
            $data = [
                'city_id' => $cityId,
                'shop_id' => $r->shopId,
                'quantity' => $item['Кол-во (отклонение)'] ?? 0,
                'new_price' => 0,
                'price' => $item['Розничная цена'] ?? 0,
            ];
            foreach ($productOk as $product) {
                if($product->code === $item['ШК товара']) {
                    $data += ['product_id'=> $product->id];
                }
            }

          array_push($newArr, $data)  ;
        }
        foreach($newArr as $item){


            $price = Price::create([
                'product_id' => $item['product_id'],
                'price' => $item['price'],
                'new_price' => $item['new_price'] && null,
                ]
            );

            Items::updateOrCreate(
                [
                    'city_id' => $item['city_id'],
                    'shop_id' => $item['shop_id'],
                    'product_id' => $item['product_id'],
                ],
                [
                    'city_id' => $item['city_id'],
                    'shop_id' => $item['shop_id'],
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price_id' => $price->id,
                ]
            );
        }

        $count = count($newArr);
        $text = [
            "title" => "Товары добавлены успешно!",
            "body" => 'Товары в количестве' . ' ' . $count . ' ' .'шт. были добавлены на склад'
        ];
        return response($text, 200);
/*
        foreach ($productOk as $product) {
            Items::updateOrCreate(
                [
                    'city_id' => $cityId,
                    'shop_id' => $r->shopId,
                    'product_id' => $product->id
                ],
                [
                    'city_id' => $cityId,
                    'shop_id' => $r->shopId,
                    'product_id' => $product->id,
                    'quantity' =>
                    'price' =>
                ]
        );
        }

*/

    }
}
