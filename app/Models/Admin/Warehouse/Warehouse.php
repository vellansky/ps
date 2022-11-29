<?php

namespace App\Models\Admin\Warehouse;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'warehouses';

    public function items()
    {
        return $this->belongsToMany(Product::class, 'warehouses_products', 'warehouse_id', 'product_id' )->withPivot('quantity');
    }
}
