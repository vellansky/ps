<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Global\Items;
use Illuminate\Http\Request;
use App\Models\User\Visitors;
use App\Models\User\Cart;


class CartController extends Controller
{




    function index(Request $request)
    {

        $city = $request->city;
        return view('user.cart', compact('city'));
    }



    function quantity(Request $request) {

        Cart::where([
            'visitor_id' => $request->cookie('visitor_id'),
            'id' => $request->id,
            ])->update(['quantity' => $request->quantity]);

        return response(null, 200);
    }

    function clearCart(Request $request) {

        Cart::where([
            'visitor_id' => $request->cookie('visitor_id'),
            ])->delete();

        return response(null, 200);
    }




    function addToCart(Request $request)
    {

        Cart::firstOrCreate([
            'visitor_id' => $request->cookie('visitor_id'),
            'visitorSession_id' => $request->cookie('session_id'),
            'quantity' => 1,
            'status' => 1,
            'product_id' => $request->product_id,
            'price_id' => $request->price_id,
        ]);

        return response(true, 200);
    }

    function deletes(Request $request) {
        Cart::where([
            'visitor_id' => $request->cookie('visitor_id'),
            'id' => $request->id,
            ])->delete();
        return response(null, 200);
    }



    function items(Request $request)
    {   $status = [3,5];
        $test = Cart::where(
            'cart.visitor_id', $request->cookie('visitor_id'),
            )
        ->whereIn('cart.status', $status)
        ->join('cities_shops_items_quantity_price', 'cities_shops_items_quantity_price.id', 'cart.product_id')
        ->join('order_status_data', 'cart.status', 'order_status_data.id')
        ->join('products', 'cities_shops_items_quantity_price.product_id', 'products.id')
        //->join('category_product', 'cities_shops_items_quantity_price.product_id', 'category_product.products_id')
        ->join('product_price', 'cities_shops_items_quantity_price.price_id', 'product_price.id')
        ->join('images', 'products.id', 'images.imageable_id', function ($image) {$image->where('imageable_type', 'product');})
        ->select(
            'products.name',
            'order_status_data.name as status_name',
            'images.url as image_url',
            'cities_shops_items_quantity_price.id as product_id',
        //    'category_product.category_id',
            'cart.id',
            'cart.status',
            'cart.quantity',
            'product_price.price',
            'product_price.new_price',
        )
        ->get();
        //->unique('product_id');

            return response($test, 200);


    }
}

