<?php

namespace App\Providers;

use App\Models\Vehicle;
use App\Policies\VehicleVerificationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Vehicle::class => VehicleVerificationPolicy::class,
        // Add other model-policy mappings here as needed
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define additional gates here if needed
        // Example:
        // Gate::define('view-dashboard', function (User $user) {
        //     return $user->isAdmin();
        // });
    }
}