<?php

namespace App\Http\Controllers\Api\Admin\Shop;

use App\Http\Controllers\Controller;
use App\Models\Global\City;
use App\Models\Global\Items;
use Illuminate\Http\Request;

use App\Models\Product\Stock;
use App\Models\Admin\Shop\Shop;
use Illuminate\Support\Str;


class ShopController extends Controller
{
    //Функция меняет статус у товара в таблице cities_shops_items_quantity_price
    public function itemStatus(Request $r){
        Items::where([
            ['shop_id', $r->shopId],
            ['product_id', $r->itemId]
            ])
            ->update(['status' => !$r->status]);
        $text = [
            "title" => "Статус у товара обнавлен",
            "body" => ''
        ];
        return response($text, 200);
    }


    public function shopList(){
        $shop = Shop::get();
        return response($shop, 200);
    }


    public function shopCreate(Request $r)
    {
        $arr = $r->toArray();

            //Создать город если нет
            $country = mb_convert_case($arr['country']['value'], MB_CASE_TITLE, "UTF-8");
            $street = mb_convert_case($arr['street']['value'], MB_CASE_TITLE, "UTF-8");
            $city = mb_convert_case($arr['city']['value'], MB_CASE_TITLE, "UTF-8");

            City::firstOrCreate([
                'name' => $city,
                'path' => Str::slug($city, '-'),
            ]);

            $shop = Shop::firstOrCreate(
                [
                    'admin_id' => 1,
                    'name' => $arr['name']['value'],
                    'country' => $country,
                    'city' => $city,
                    'street' => $street,
                    'house_number' => $arr['houseNumber']['value'],
                    'telephone' => $arr['telephone']['value'],
                ]);
            $text = [
                "title" => 'Магазин создан',
                "body" => 'Магазин' . ' ' . $shop->name . " " . "доступен для настройки"
            ];
            return response($text, 200);

    }




    public function itemAdd(Request $r)
    {
        $arr = $r->toArray();
        foreach ($arr['items'] as $product) {
            Stock::updateOrCreate(
                [
                'product_id' => $product['id'],
                'shop_id' => $r->shopId,
                ],
                [
                    'product_id' => $product['id'],
                    'shop_id' => $r->shopId,
                    'quantity' => 1,
                ]);
        }
        $text = [
            "title" => "Товары добавлены в магазин",
            "body" => ''
        ];
        return response($text, 200);
    }

    public function test()
    {
        $items = Items::get();
        return response($items, 200);
    }

    public function getItemList(Request $r)
    {
        $items = Shop::find($r->id)->products;

        $test = [];

        foreach ($items as $item) {

            $item['price'] = $item->pivot['price'];
            $item['new_price'] = $item->pivot['new_price'];
            $item['quantity'] = $item->pivot['quantity'];
            $item['status'] = boolval($item->pivot['status']);
            unset($item['created_at'], $item['updated_at'], $item['code'], $item['description'], $item['pivot']);
            array_push($test, $item);
        }
        return response($test, 200);
    }

    public function itemQuantity(Request $r)
    {
        Stock::where(['shop_id', $r->shopId], ['product_id', $r->ProductId])->update([
            'quantity' => $r->quantity,
        ]);
        $item = Product::where('product_id', $r->ProductId)->first();
        $text = [
            "title" => 'Товар успешно обновлен',
            "body" => 'Количество у' . ' ' . $item->name . " " . "обновлено. Текущее" . ' ' . $r->quantity
        ];
        return response($text, 200);
    }

    public function itemVisibility(Request $r)
    {
        Stock::where(['shop_id', $r->shopId], ['product_id', $r->ProductId])->update([
            'status' => $r->status,
        ]);
        $text = [
            "title" => 'Статус изменен успешно',
            "body" => ''
        ];
        return response($text, 200);
    }

    public function editData(Request $r)
    {
        Shop::where('id', $r->id)->update([
            'name' => $r->name,
        ]);
        $text = [
            "title" => 'Имя изменено успешно',
            "body" => 'У магазина новое имя:' . ' ' . $r->name
        ];
        return response($text, 200);
    }

    public function editContact(Request $r)
    {
        $contact = [];
        if(!empty($r['data']['telephone'])) {
            $contact['telephone'] = $r['data']['telephone'];
        }
        if(!empty($r['data']['address']['country'])) {
            $contact['country'] = $r['data']['address']['country'];
        }
        if(!empty($r['data']['address']['city'])) {
            $contact['city'] = $r['data']['address']['city'];
        }
        if(!empty($r['data']['address']['street'])) {
            $contact['street'] = $r['data']['address']['street'];
        }
        if(!empty($r['data']['address']['house_number'])) {
            $contact['house_number'] = $r['data']['address']['house_number'];
        }
        Shop::where('id', $r->id)->update($contact);
        $text = [
            "title" => 'У магазина новые контактные данные',
            "body" => ''
        ];
        return response($text, 200);
    }
}
