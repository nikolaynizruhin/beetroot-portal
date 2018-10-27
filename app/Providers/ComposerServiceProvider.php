<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\UsersComposer;
use App\Http\ViewComposers\ClientsComposer;
use App\Http\ViewComposers\UserFiltersComposer;
use App\Http\ViewComposers\ClientFiltersComposer;
use App\Http\ViewComposers\BirthdayFiltersComposer;

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
            UsersComposer::class
        );

        View::composer(
            'users.index',
            UserFiltersComposer::class
        );

        View::composer(
            ['clients.create', 'clients.edit'],
            ClientsComposer::class
        );

        View::composer(
            'clients.index',
            ClientFiltersComposer::class
        );

        View::composer(
            'birthdays.index',
            BirthdayFiltersComposer::class
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
