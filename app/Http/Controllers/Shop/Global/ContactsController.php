<?php

namespace App\Http\Controllers\Shop\Global;

use App\Http\Controllers\Controller;
use App\Models\Admin\Shop\Shop;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index()
    {
        $shop = Shop::get();

        return view('user.contacts.ContactsPage', compact('shop'));
    }
}
