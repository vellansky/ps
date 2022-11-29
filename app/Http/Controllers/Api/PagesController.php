<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Global\Items;
use App\Models\Product\Product;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use App\Models\Products;


class PagesController extends Controller
{
    public function search(Request $request)
    {
        $search = mb_strtolower(strval($request->s));
        $products = Items::where('city_id', 1)
        ->join('products', function ($product) use ($search) {
            $product->on('cities_shops_items_quantity_price.product_id', 'products.id')
            ->where('name', 'LIKE', "%{$search}%");
        })
        ->select(
            'products.name'
        )
        ->get()->take(4)->sort();
        return response($products, 200);

    }
}
