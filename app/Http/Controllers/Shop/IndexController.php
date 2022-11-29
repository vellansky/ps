<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User\Visitor;
use App\Models\User\VisitorSession;
use App\Models\User\VisitorData;
use App\Models\CategoryProducts;
use App\Models\Global\City;
use App\Models\Global\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IndexController extends Controller
{
    function index(Request $request)
    {

        
        return response()->view('user.index', compact('products', 'city'), 200);
    }
}
