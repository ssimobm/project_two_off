<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mApp\Modelsings for the App\Modelslication.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Models\Model' => 'App\Models\Policies\ModelPolicy',
                'App\Models\User' => 'App\Policies\RolesAuthPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
