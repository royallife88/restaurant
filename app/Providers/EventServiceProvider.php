<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\System;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
            $order_count = Order::where('status', 'pending')->count();
            $event->menu->addAfter('offers', [
                'key' => 'orders',
                'text' => 'orders',
                'route'  => 'orders.index',
                'icon' => 'fas fa-edit',
                'label' => $order_count,
                'label_color' => 'success',
            ]);
            // $event->menu->addAfter('system_settings', [
            //     'key' => 'language',
            //     'text' => __('lang.' . app()->getLocale()),
            //     'url'  =>  '/',
            //     'icon' => 'fas fa-language',
            //     'topnav_right' => true,
            //     'submenu' => [
            //         [
            //             'text' => 'Arabic',
            //             'url'  => url('/ar/admin/dashboard'),
            //         ],
            //         [
            //             'text' => 'Deutsch',
            //             'url'  => url('/nl/admin/dashboard'),
            //         ],
            //         [
            //             'text' => 'English',
            //             'url'  => url('/en/admin/dashboard'),
            //         ],
            //         [
            //             'text' => 'Turkce',
            //             'url'  => url('/tr/admin/dashboard'),
            //         ],
            //         [
            //             'text' => 'فارسی',
            //             'url'  => url('/fa/admin/dashboard'),
            //         ],
            //     ]
            // ]);

            config(['adminlte.logo_img' => asset('/uploads/' . session('logo'))]);
            config(['adminlte.logo' => System::getProperty('site_title')]);
        });
    }
}
