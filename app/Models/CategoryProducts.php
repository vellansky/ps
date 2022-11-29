<?php

namespace App\Models;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProducts extends Model
{
    use HasFactory;
    protected $table = 'category_product';
    protected $guarded = [];

    function products()
    {
        return $this->hasMany(Product::class, 'id', 'products_id');
    }
}
