<?php

namespace App\Models\Global;

use App\Models\Category;
use App\Models\CategoryProducts;
use App\Models\Orders;
use App\Models\Product\Product;
use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slug extends Model
{
    use HasFactory;
    protected $table = 'slug';
    protected $guarded = [];
    public $timestamps = false;



    function order($id ){
        $order = Orders::where('orders.id', $id)
            ->join('order_status_data', 'orders.status_id', 'order_status_data.id')
            ->join('shops', 'orders.take_shop_id', 'shops.id')
            ->select('orders.id', 'orders.client_order_id', 'order_status_data.name as status_name', 'shops.city', 'shops.street', 'shops.house_number', 'shops.telephone',)
            ->with('products')->first();

        return $order;
    }

    function product($id, $city){
        $product = Items::where([
            ['cities_shops_items_quantity_price.status', 1],
            ['cities_shops_items_quantity_price.city_id', $city],
            ['cities_shops_items_quantity_price.product_id', $id]
            ])
        ->join('products', 'cities_shops_items_quantity_price.product_id', 'products.id')
        ->join('product_price', 'cities_shops_items_quantity_price.price_id', 'product_price.id')
        ->leftJoin('category_product', 'products.id', 'category_product.products_id')
        ->leftJoin('category', 'category_product.category_id', 'category.id')
        ->leftJoin('images', function ($image) {
            $image->on('products.id', 'images.imageable_id')
            ->where('imageable_type', 'product');
        })
        ->select(
            'cities_shops_items_quantity_price.shop_id',
            'cities_shops_items_quantity_price.city_id',
            'cities_shops_items_quantity_price.quantity',

            'products.id as product_id',
            'products.name as product_name',
            'products.name as product_name',
            'products.description',

            'product_price.id as price_id',
            'product_price.price',
            'product_price.new_price',

            'images.name as images_name',
            'images.url as image_url',
        )
        ->first();
        return $product;
    }

    function category($id, $city){

        $test = Category::where('category.id', $id)
            ->with('products', function ($where) use ($city) {
                $where->where('cities_shops_items_quantity_price.status', 1);
                $where->where('cities_shops_items_quantity_price.city_id', $city);
            })->first();
        return $test;
    }


    function products()
    {
        return $this->hasMany(CategoryProducts::class, 'category_id', 'essence_id')
            ->join('cities_shops_items_quantity_price', 'category_product.products_id', 'cities_shops_items_quantity_price.product_id')
            ->join('products', 'cities_shops_items_quantity_price.product_id', 'products.id')
            ->join('images', 'cities_shops_items_quantity_price.product_id', 'images.id')
            ->leftJoin('slug', 'products.id', 'essence_id')

            ->select('category_product.*',
                'slug.name as slug_name',
                'slug.slug as slug_path',
                'products.name as name',
                'products.id as product_id',
                'price',
                'new_price',
                'description',
                'images.name as image_name',
                'images.url as image_url',
                'cities_shops_items_quantity_price.shop_id',
                'cities_shops_items_quantity_price.city_id',
                'cities_shops_items_quantity_price.quantity',

            );
    }


}
