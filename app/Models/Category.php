<?php

namespace App\Models;
use App\Models\Global\Items;
use App\Models\Product\Product;
use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $guarded = [];


    public function products()
    {
        return $this->hasMany(CategoryProducts::class,'category_id', 'id')
            ->join('cities_shops_items_quantity_price', 'category_product.products_id', 'cities_shops_items_quantity_price.product_id')
            ->join('products', 'cities_shops_items_quantity_price.product_id', 'products.id')
            ->join('product_price', 'cities_shops_items_quantity_price.price_id', 'product_price.id')
            ->join('slug', function ($slug) {
                $slug->on('products.id', 'slug.essence_id')->
                where('essence_type', 'product');
            })
            ->join('images', 'products.id', 'images.imageable_id', function($image) {
                $image->where('imageable_type', 'product');
            })
            ->select(
                'cities_shops_items_quantity_price.id as product_id',
                'cities_shops_items_quantity_price.shop_id',
                'cities_shops_items_quantity_price.city_id',
                'cities_shops_items_quantity_price.price_id',
                'category_product.category_id',
                'products.name as product_name',
                'product_price.price',
                'product_price.new_price',
                'images.name as image_name',
                'images.url as image_url',
                'slug.slug as slug_path'
            )
            ;
    }

    public function image()
    {
        return $this->morphOne(Images::class, 'imageable');
    }

}
