<?php

namespace App\Models\Admin\Orders;

use App\Models\Customer\Customers;
use App\Models\Order\items;
use App\Models\Order\Status;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $guarded = [];

    function products() {
        return $this->hasMany(items::class, 'order_id')
        ->join('cart', 'order_items.cart_id', 'cart.id')
        ->join('products', 'cart.product_id', 'products.id')
        ->join('product_price', 'cart.price_id', 'product_price.id')
        ->join('order_status_data', 'cart.status', 'order_status_data.id')
        ->select(
            'products.name',
            'product_price.price',
            'product_price.new_price',
            'order_status_data.name as status',
            'order_items.order_id',
            'cart.quantity',
            'order_status_data.id as status_id',

        )

        ;
    }
    public function status()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function customer()
    {
        return $this->hasOne(Customers::class, 'id', 'customer_id')->with('contact', 'address');
    }

    public function items()
    {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'item_id', 'id')->withPivot('quantity', 'price');
    }
}
