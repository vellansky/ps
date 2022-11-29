<?php

namespace App\Models\Product;

use App\Models\Category;
use App\Models\CategoryProducts;
use App\Models\Images;
use App\Models\Price;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $guarded = [];


    public function price()
    {
        return $this->hasOne(Price::class, 'product_id', 'id')->latest();
    }
    public function slug()
    {
        return $this->morphOne(Images::class, 'imageable');
    }

    public function images()
    {
        return $this->morphOne(Images::class, 'imageable');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'products_id', 'category_id');
    }


}
