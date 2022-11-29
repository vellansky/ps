<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Shop;

class ShopController extends Controller
{
    public function getShops()
    {
        $shop = Shop::get();
        return response($shop, 200);
    }
}
