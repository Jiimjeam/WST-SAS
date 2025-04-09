<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Tenant;

class IdentifyTenant
{
    public function handle(Request $request, Closure $next)
    {
        $domain = $request->getHost();

        $tenant = Tenant::where('domain', $domain)->first();

        if (!$tenant) {
            abort(404, 'Tenant not found.');
        }

        // Share tenant data globally
        app()->instance('currentTenant', $tenant);

        return $next($request);
    }
}
