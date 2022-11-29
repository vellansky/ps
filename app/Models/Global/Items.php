<?php

namespace App\Models\Global;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;
    protected $table = 'cities_shops_items_quantity_price';
    protected $guarded = [];
    protected $casts = [
        'status' => 'boolean',
    ];


}
