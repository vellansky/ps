<?php

namespace App\Models;

use App\Models\Order\items;
use App\Models\Product\Product;
use App\Models\User\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $guarded = [];

    public function customer()
    {
        return $this->hasOne(Customers::class, 'id', 'customer_id');
    }
    public function products()
    {
        return $this->hasMany(Items::class, 'order_id', 'id')
        ->join('cart', 'order_items.cart_id', 'cart.id')
        ->join('product_price', 'cart.price_id', 'product_price.id')
        ->join('products', 'product_price.product_id', 'products.id')
        ->select(
            'order_items.order_id',
            'cart.quantity',
            'cart.status',
            'product_price.price',
            'product_price.new_price',
            'products.name',
        )
        ;

    }
}
