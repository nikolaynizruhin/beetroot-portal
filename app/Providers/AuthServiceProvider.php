<?php

namespace App\Providers;

use App\User;
use App\Client;
use App\Office;
use App\Policies\UserPolicy;
use App\Policies\ClientPolicy;
use App\Policies\OfficePolicy;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Client::class => ClientPolicy::class,
        Office::class => OfficePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
    }
}
