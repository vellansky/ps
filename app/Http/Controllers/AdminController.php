<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function warehouse()
    {
        return view('admin.warehouse.index');
    }
    public function products()
    {
        return view('admin.products.index');
    }
    public function orders()
    {
        return view('admin.orders.index');
    }
    public function categories()
    {
        return view('admin.categories.index');
    }
    public function settings()
    {
        return view('admin.settings.index');
    }
}
