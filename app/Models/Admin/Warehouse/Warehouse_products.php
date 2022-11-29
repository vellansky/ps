<?php

namespace App\Models\Admin\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse_products extends Model
{
    use HasFactory;
    protected $table = 'warehouses_products';
    protected $guarded = [];

}
