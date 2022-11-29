<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\SitePolicy;

class PolicyController extends Controller
{
    function ok(Request $request)
    {
        SitePolicy::firstOrCreate([
            'visitor_id' => $request->cookie('visitor_id'),
            'site_policy' => true,
        ]);
        return response(null, 200);
    }
}
