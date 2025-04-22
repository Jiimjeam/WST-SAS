<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Tenant;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {



        Gate::define('is-admin', function ($user) {
            return $user->position === 'admin';
        });


        // Define a custom Gate for checking if the tenant is disabled
        Gate::define('check-tenant-statusAorD', function ($user) {
            // Assuming the tenant is associated with the user's domain or session
            $tenant = Tenant::where('domain', request()->getHost())->first(); // Adjust based on your logic

            if ($tenant && $tenant->statusAorD == 'disabled') {
                return false; // Tenant is disabled
            }

            return true; // Tenant is active
        });
    }
}
