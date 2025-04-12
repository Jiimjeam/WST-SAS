<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Models\Tenant;

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    
    Route::get('/', function () {
        $tenant = tenant(); // or Tenant::current() if you're resolving manually
    
        return view('tenant.tenant', [
            'tenant' => $tenant, // pass full object
        ]);
    })->name('tenant.tenant');
    

    


    Route::get('/profile', function () {
        return view('tenant.profile');
    })->name('tenant.profile');


    
   
    Route::fallback(function () {
        return response('Tenant page not found.', 404);
    });
});
