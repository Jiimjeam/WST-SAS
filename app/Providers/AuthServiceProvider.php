<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Admin;

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



       

        Gate::define('check-tenant-statusAorD', function (?User $user = null) {
            $tenant = Tenant::where('domain', request()->getHost())->first();
        
            \Log::info("Tenant status for domain " . request()->getHost() . ": " . ($tenant ? $tenant->statusAorD : 'N/A'));
        
            if ($tenant && $tenant->statusAorD === 'disabled') {
                return false;
            }
        
            return true;
        });
        
    }
}
