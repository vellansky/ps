<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Customers;
use App\Models\OrderProducts;
use App\Models\Products;

class OrderController extends Controller
{
    public function getOrders()
    {
        return Orders::with('customer', 'products')->get();
    }

    public function addOrder(Request $req)
    {

        $customer = Customers::firstOrCreate([
            'name' => $req->name,
            'tel' => $req->phoneNumber,
            'address' => $req->address
        ]);

        $product = $req->order;

        foreach ($product as $product) {
            $quantityProductInDB = Products::where('id', $product['id'])->value('quantity');
            $quantityProductInOrder = $product['quantity'];
            $quantity = $quantityProductInDB - $quantityProductInOrder;

            Products::where("id", $product['id'])->update(['quantity' => $quantity]);
        }
        $orderId = Orders::create([
            'customer_id' => $customer->id,
            'status' => 'Новый',
        ]);


        $order = $req->order;
        foreach($order as $product)
                OrderProducts::create([
                    'order_id' => $orderId->id,
                    'products_id' => $product['id'],
                    'price' => $product['price'],
                    'quantity' => $product['quantity'],
                ]);


        return response($orderId->id, 200);
    }
}
