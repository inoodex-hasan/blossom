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
            (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ||
            (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ||
            str_starts_with(config('app.url', ''), 'https://')
        ) {
            URL::forceScheme('https');
        }

        // Ensure critical storage directories exist for Livewire & Filament temporary uploads
        try {
            $storageDirs = [
                storage_path('app/private/livewire-tmp'),
                storage_path('app/livewire-tmp'),
                storage_path('app/public/hero-slides'),
                storage_path('app/public/products'),
                storage_path('app/public/our-stories'),
                storage_path('app/public/site-settings'),
                storage_path('framework/cache/data'),
                storage_path('framework/sessions'),
                storage_path('framework/views'),
            ];

            foreach ($storageDirs as $dir) {
                if (!file_exists($dir)) {
                    @mkdir($dir, 0777, true);
                }
                @chmod($dir, 0777);
            }
        } catch (\Throwable $e) {
            // Graceful fallback
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
