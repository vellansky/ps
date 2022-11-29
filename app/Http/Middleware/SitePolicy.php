<?php

namespace App\Http\Middleware;

use App\Models\User\SitePolicy as UserSitePolicy;
use Closure;
use Illuminate\Http\Request;

class SitePolicy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $check = UserSitePolicy::where('visitor_id', $request->visitor_id)->latest()->first();

        $request->merge([
            "policy" => $check,
        ]);
        return $next($request);
    }
}
