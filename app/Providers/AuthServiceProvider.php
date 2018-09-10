<?php

namespace App\Providers;
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
        'App\Model' => 'App\Policies\ModelPolicy',
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
        Passport::tokensExpireIn(now()->addHours(2));
        Passport::refreshTokensExpireIn(now()->addHours(2));
        Passport::tokensCan([
            'web' => 'NanoSTIMA Web Platform',
            'mobile-prescription' => 'Mobile app prescription',
            'mobile-time' => 'Mobile app time' 
        ]);
    }
}
