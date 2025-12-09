<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\SiteSetting;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Cache the site setting for better performance
        $siteSetting = Cache::remember('siteSetting', 3600, function () {
            return SiteSetting::first();
        });

        // Cache all settings and key them by ID
        $settings = Cache::remember('settings', 3600, function () {
            return Setting::all()->keyBy('id');
        });

        // Share siteSetting and settings globally with all views
        View::share([
            'siteSetting' => $siteSetting,
            'settings' => $settings,
        ]);
    }
}
