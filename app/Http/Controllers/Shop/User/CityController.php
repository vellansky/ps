<?php

namespace App\Http\Controllers\Shop\User;

use App\Http\Controllers\Controller;
use App\Models\Global\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    function UserCity(Request $request)
    {
        $cookieMinute = time()+86400 * 30 * 12;
        $cookie = cookie('city', $request->id, $cookieMinute);

        return response(null,200)
        ->withCookie($cookie);
    }

    function list(Request $request)
    {
        //return response($request->cookie('city'), 200);

        $data = [
            'status' => true,
            'list' => $data['list'] = City::get(),
        ];

        if(intval($request->cookie('city')) === 1) {
            $data['status'] = false;
        }
        return response($data, 200);
    }
}
