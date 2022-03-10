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

        if (empty(session('logo'))) {
            $logo = System::getProperty('logo');
            if (empty($logo)) {
                $logo = 'sharifshalaby.png';
            }
            $request->session()->put('logo', $logo);
        }
        if (empty(session('home_background_image'))) {
            $home_background_image = System::getProperty('home_background_image');
            if (empty($home_background_image)) {
                $home_background_image = null;
            }
            $request->session()->put('home_background_image', $home_background_image);
        }
        if (empty(session('breadcrumb_background_image'))) {
            $breadcrumb_background_image = System::getProperty('breadcrumb_background_image');
            if (empty($breadcrumb_background_image)) {
                $breadcrumb_background_image = null;
            }
            $request->session()->put('breadcrumb_background_image', $breadcrumb_background_image);
        }
        if (empty(session('page_background_image'))) {
            $page_background_image = System::getProperty('page_background_image');
            if (empty($page_background_image)) {
                $page_background_image = null;
            }
            $request->session()->put('page_background_image', $page_background_image);
        }

        return $next($request);
    }
}
