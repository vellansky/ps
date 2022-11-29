<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\User\Visitor;
use App\Models\User\VisitorSession;
use App\Models\User\VisitorData;
use App\Models\Global\City;
use Illuminate\Support\Str;

class VisitorRegistration
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

        $city = City::where('path', $request->route('city') ?? 'tomsk')->first();
        $id_city = $city->id ?? 1;
        $hasCity = boolval($city);
        $shop = null;
        $previous_url = $request->session()->get('_previous.url');
        $next_url = $request->fullUrl();
        $ipAddres = $request->ip();

        $visitor = Visitor::where('visitor', $request->cookie('papasmoke_visitor'))->first();
        if(!empty($visitor)){
            Visitor::where('visitor', $request->cookie('papasmoke_visitor'))->touch();
        } else {
            $visitor = Visitor::create(['visitor' => Str::uuid(), 'city_id' => $id_city, 'shop_id' => $shop]);
        };

        if(!$request->cookie('city') && boolval($visitor) && $hasCity) {
            Visitor::where('visitor', $request->session()->get('_token'))->update(['city_id' => $id_city]);
        }

        // Сохранить сессию для зарегистрированного посетителя
        $sessionId = $request->cookie('session_id');
        if(empty($sessionId)){
            $VisitorSession = [
                'visitor_id' => $visitor->id,
            ];

            $sessionCreate = VisitorSession::create($VisitorSession);
            $sessionId = $sessionCreate->id;
        }

        // / Сохранить сессию для зарегистрированного посетителя

        //Сохранить данные посетителя


        $VisitorData = [
            'visitor_session' => $sessionId,
            'previous_url' => $previous_url,
            'next_url' => $next_url,
            'ip_address' => $ipAddres,
        ];

        $sessionDataCreate = VisitorData::create($VisitorData);

        ///Сохранить данные посетителя



        $request->merge([
            "city" => $city,
            "id_shop" => null,
            "visitor_id" => $visitor->id,
        ]);



        return $next($request)
        ->withCookie(cookie('session_id', $sessionId))
        ->withCookie(cookie()->forever('papasmoke_visitor', $visitor->visitor))
        ->withCookie(cookie()->forever('visitor_id', $visitor->id))
        ->withCookie(cookie()->forever('city', $hasCity));
    }
}
