<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    public function setCity(Request $req)
    {
        return response($req->city, 200)->withCookie(cookie()->forever('city', $req->city));

    }
}
