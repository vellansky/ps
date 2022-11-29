<?php

namespace App\Models\Global;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Global\Items;
use App\Models\Product\Product;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';
    protected $guarded = [];
    public $timestamps = false;
}
