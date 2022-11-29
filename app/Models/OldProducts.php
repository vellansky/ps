<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $guarded = [];



    public function images()
    {
        return $this->hasMany(Photos::class, 'product_id', 'id'); 
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function price()
    {
        return $this->hasOne(Price::class, 'product_id', 'id')->latest();
    }
    public function photo()
    {
        return $this->morphOne(Images::class, 'imageable');
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttributes::class, 'product_id')->with('attribute');
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_products', 'products_id', 'category_id');
    }
}
