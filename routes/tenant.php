<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;



Route::middleware([
    'web',
    \Stancl\Tenancy\Middleware\InitializeTenancyByDomain::class,
    \Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        $tenant = tenant(); // Get the current tenant object

        return view('tenant.dashboard', [
            'tenantName' => $tenant->name ?? 'No Name',
            'tenantDomain' => $tenant->domain ?? 'No Domain',
        ]);
    });
});

