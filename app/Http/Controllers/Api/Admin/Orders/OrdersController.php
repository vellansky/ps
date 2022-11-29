<?php

namespace App\Http\Controllers\Api\Admin\Orders;

use App\Http\Controllers\Controller;
use App\Models\Admin\Orders\Orders;
use App\Models\Admin\Shop\Shop;
use App\Models\Customer\Contact;
use App\Models\Customer\Customers;
use App\Models\Global\Items as GlobalItems;
use App\Models\Global\Slug;
use App\Models\Order\items;
use App\Models\Order\Status;
use App\Models\User\Cart;
use App\Models\User\VisitorCustomer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class OrdersController extends Controller
{
    public function list()
    {
        $orders = Orders::
        join('order_status_data', 'orders.status_id', 'order_status_data.id')
        ->join('customers', 'orders.customer_id', 'customers.id')
        ->join('customer_contact', 'customers.contact_id', 'customer_contact.id')
        ->join('shops', 'orders.take_shop_id', 'shops.id')
        ->select(
            'orders.id',
            'orders.client_order_id',
            'order_status_data.name as status',
            'customers.customer_name as name',
            'customer_contact.contact',
            'shops.country',
            'shops.city',
            'shops.street',
            'shops.house_number',
        )
        ->get();
        return response($orders, 200);
    }
    function editStatus(Request $request)
    {
        Orders::where('id', $request->id)->update(['status_id' => $request->status]);
        return response(null,200);
    }
    function listStatus()
    {
        $status = Status::where('id', '!=', 5 )->get();
        return response($status, 200);
    }
    public function detail(Request $r)
    {
        $order = Orders::where('orders.id', $r->id)
        ->join('order_status_data', 'orders.status_id', 'order_status_data.id')
        ->join('customers', 'orders.customer_id', 'customers.id')
        ->join('customer_contact', 'customers.contact_id', 'customer_contact.id')
        ->join('shops', 'orders.take_shop_id', 'shops.id')
        ->with('products')
        ->select(
            'orders.id',
            'orders.client_order_id',
            'order_status_data.name as status',
            'customers.customer_name as name',
            'customer_contact.name as contact_name',
            'customer_contact.contact',
            'shops.country',
            'shops.city',
            'shops.street',
            'shops.house_number',
        )
        ->first();
        return response($order, 200);
    }


    function addOrder(Request $request){

        $name = mb_strtolower($request->name);

        $telephone = preg_replace('/[^0-9]/', "", $request->tel);

        $contact = Contact::where('contact', $telephone)
        ->join('customers', 'customers.contact_id', 'customer_contact.id')->select('customer_contact.id', 'customers.customer_name as name', 'customer_contact.contact')
        ->first();


        if(!empty($contact)) {
            if( $contact->name !== $name ) {

                $customer = Customers::create([
                    'customer_name' => $name,
                    'contact_id' => $contact->id,
                ]);
            }
        }
        else {
            $contact = Contact::firstOrCreate([
                'name' => 'Телефон',
                'contact' => $telephone
            ]);

            $contact = Customers::create([
                'customer_name' => $name,
                'contact_id' => $contact->id
            ]);
        };

        CommitCustomer($request->cookie('visitor_id'), $contact->id);



        $order = createOrder($request->cart, $contact->id, $request->shop, $request->cookie('visitor_id'));
        $slug = createOrderSlug($order->id);

        $cart = Cart::where([
            ['visitor_id', $request->cookie('visitor_id')],

            ])->get();
            $items = [];
            foreach($cart as $item){
                $data = [
                    'order_id' => $order->id,
                    'cart_id' => $item->id,
                ];
                array_push($items, $data);
            }

        checkCartAndItems($cart);

        orderItems($items);

        $shop = Shop::where('id', $request->shop)->select('country', 'city', 'street', 'house_number', 'telephone')->first();
        $data = [
                'id' => $order->client_order_id,
                'shop' => $shop,
                'slug' => $slug,
        ];

        return response($data, 200);
    }

}
    function createOrder ($cart, $customer, $take, $visitor){

        $count = Orders::query()->where('created_at','>', Carbon::today())->count();
        $id = $visitor . '-' . $count;

        $order = Orders::create([
            'client_order_id' => $id,
            'status_id' => 1,
            'customer_id' => $customer,
            'take_shop_id' => $take,
        ]);

        return $order;


    }
    function orderItems($items){
        foreach($items as $item) {
            items::create($item);
        }
    }
    function updateStatusCart($cart)
    {
        foreach($cart as $cart) {
            Cart::where('id', $cart->id)->update(['status' => 2]);
        }
    }

    function createOrderSlug($id){

       $slug =  Slug::create([
            'slug' => Str::uuid(),
            'essence_id' => $id,
            'essence_type' => 'order',
        ]);
        return $slug->slug;
    }

    function CommitCustomer($c, $id){
        VisitorCustomer::firstOrCreate([
            'visitor_id' => $c,
            'customer_id' => $id,
        ]);
    }


    function checkCartAndItems($cart){
        //получить ид товаров чтобы вытащить их из таблицы


        $arrayId = [];
        foreach($cart as $cartItem){
            array_push($arrayId, $cartItem->product_id);
        }
        $items = GlobalItems::whereIn('id', $arrayId)->get()->toArray();

        //$test123123 = Arr::keyBy($items, 'id');
        $status2 = [];
        foreach($cart as $cartItem){


            $itemInShop = array_filter($items, function ($findItem) use ($cartItem) {
               return $findItem['id'] === $cartItem['product_id'];
            });

            $first = reset($itemInShop);
            if($first['quantity'] <= 0) {
                Cart::where('id', $cartItem->id)->update(['status' => 3]);
                continue;
            };



            $validQuantity = $first['quantity'] - $cartItem['quantity'];
            if($validQuantity >= 0) {
                GlobalItems::where('id', $first['id'])->update(['quantity' => $validQuantity]);
                array_push($status2, $cartItem);
                continue;
            }
            else {
                Cart::where('id', $cartItem->id)->update(['quantity' => $first['quantity'], 'status' => 4]);
                GlobalItems::where('id', $first['id'])->update(['quantity' => 0]);
                continue;
            }

        }

        updateStatusCart($status2);
    }
