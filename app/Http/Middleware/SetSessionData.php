<?php

namespace App\Http\Middleware;

use App\Models\Currency;
use App\Models\StorePos;
use App\Models\System;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SetSessionData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user_id = Session::get('user_id');
        if (empty($user_id)) {
            $user_id = uniqid('USER_');
            Session::put('user_id', $user_id);
            Session::save();
        }

        $currency_id = System::getProperty('currency');
        if (empty($currency_id)) {
            $currency_data = [
                'country' => 'Qatar',
                'symbol' => 'QR',
                'decimal_separator' => '.',
                'thousand_separator' => ',',
                'currency_precision' => 2,
                'currency_symbol_placement' => 'before',
            ];
        } else {
            $currency = Currency::find($currency_id);
            $currency_data = [
                'country' => $currency->country,
                'code' => $currency->code,
                'symbol' => $currency->symbol,
                'decimal_separator' => '.',
                'thousand_separator' => ',',
                'currency_precision' => 2,
                'currency_symbol_placement' => 'before',
            ];
        }
        $request->session()->put('currency', $currency_data);

        $logo = System::getProperty('logo');
        if (empty($logo)) {
            $logo = 'sharifshalaby.png';
        }
        $request->session()->put('logo', $logo);


        $home_background_image = System::getProperty('home_background_image');
        if (empty($home_background_image)) {
            $home_background_image = null;
        }
        $request->session()->put('home_background_image', $home_background_image);


        $breadcrumb_background_image = System::getProperty('breadcrumb_background_image');
        if (empty($breadcrumb_background_image)) {
            $breadcrumb_background_image = null;
        }
        $request->session()->put('breadcrumb_background_image', $breadcrumb_background_image);



        $page_background_image = System::getProperty('page_background_image');
        if (empty($page_background_image)) {
            $page_background_image = null;
        }
        $request->session()->put('page_background_image', $page_background_image);


        return $next($request);
    }
}
