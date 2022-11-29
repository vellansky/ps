<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    use HasFactory;
    protected $table = 'orders_products';
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Products::class, 'orders_products', 'id', 'products_id');
 
    }
}
