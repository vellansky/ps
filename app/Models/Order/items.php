<?php

namespace App\Models\Order;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class items extends Model
{
    use HasFactory;
    protected $table = 'order_items';
    protected $guarded = [];

    public function product()
    {
        return $this->belongsToMany(Product::class, 'order_items', 'id', 'item_id', 'id')->withPivot('quantity', 'price');
    }
}
