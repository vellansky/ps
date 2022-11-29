<?php

namespace App\Models\Admin\Shop;

use App\Models\Category;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $table = 'shops';
    protected $guarded = [];

    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'cities_shops_items_quantity_price')->withPivot('status','price','new_price','quantity');
    }
}
