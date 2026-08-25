<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        if (
            config('app.env') === 'production' ||
            (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
        ) {
            URL::forceScheme('https');
        }

        // Share global dynamic data with all views
        View::composer('*', function ($view) {
            $headerProducts = collect();
            $siteSettings = [];

            try {
                if (Schema::hasTable('products')) {
                    $headerProducts = Product::all();
                }
                if (Schema::hasTable('site_settings')) {
                    $siteSettings = SiteSetting::allAsArray();
                }
            } catch (\Throwable $e) {
                // Graceful fallback during installation/migrations
            }

            $view->with('headerProducts', $headerProducts);
            $view->with('siteSettings', $siteSettings);
        });
    }
}
