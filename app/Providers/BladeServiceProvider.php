<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('host', function ($url) {
            return "<?php echo str_replace('www.', '', parse_url($url, PHP_URL_HOST)); ?>";
        });

        Blade::if('admin', function () {
            return auth()->user()->is_admin;
        });

        Blade::if('employee', function () {
            return ! auth()->user()->is_admin;
        });

        Blade::if('routeis', function ($route) {
            return Route::currentRouteName() === $route;
        });

        Blade::directive('date', function ($expression) {
            return "<?php echo ($expression)->format('d F Y'); ?>";
        });
    }
}
