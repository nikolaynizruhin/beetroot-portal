<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            ['users.create', 'users.edit'],
            'App\Http\ViewComposers\UsersComposer'
        );

        View::composer(
            'users.index',
            'App\Http\ViewComposers\UserFiltersComposer'
        );

        View::composer(
            'clients.index',
            'App\Http\ViewComposers\ClientFiltersComposer'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
