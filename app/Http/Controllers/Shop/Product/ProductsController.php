<?php

namespace App\Http\Controllers\Shop\Product;

use App\Http\Controllers\Controller;
use App\Models\Global\Slug;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request, $city, $path)
    {
        $product = Slug::
        where([
            ['slug', $path],
            ['essence_type', 'product']
        ])
        ->where([
            ['cities_shops_items_quantity_price.status', 1],
            ['cities_shops_items_quantity_price.shop_id', 1],
            ['cities_shops_items_quantity_price.city_id', 1]
        ])
        ->join('cities_shops_items_quantity_price', 'essence_id', 'cities_shops_items_quantity_price.product_id')
        ->join('products', 'cities_shops_items_quantity_price.product_id', 'products.id')
        ->join('images', 'cities_shops_items_quantity_price.product_id', 'images.id')
        ->join('category_product', 'category_product.products_id', 'products.id')
        ->join('category', 'category_product.category_id', 'category.id')
        ->join('product_price', 'cities_shops_items_quantity_price.price_id', 'product_price.id')
        ->select(
            'cities_shops_items_quantity_price.quantity',
            'cities_shops_items_quantity_price.price_id',
            'cities_shops_items_quantity_price.shop_id',
            'cities_shops_items_quantity_price.city_id',

            'images.name as image_name',

            'slug.slug',

            'products.name as name',
            'products.id as product_id',

            'product_price.id as price_id',
            'product_price.price',
            'product_price.new_price',

            'images.name as image_name',
            'images.url as image_url',


            'products.description',

            'category.name as category_name',
            'category.id as category_id',
        )
            ->first();

        return view('user.product.index', compact('product'));
    }
}
