<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slug extends Model
{
    use HasFactory;
    protected $table = 'product_slug';
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id')->with('photo', 'attributes', 'price');
    }
}
