<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\MedecineCRUDESController;
use App\Models\Tenant;
use App\Models\Medicine;

use App\Http\Controllers\TenantLoginAuthController;


Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {



    Route::get('/tenant/login', function () {
        return view('tenant.login');
    })->name('tenant.login');


    Route::post('tenant/login', [TenantLoginAuthController::class, 'login'])->name('tenant.login.submit');
    Route::post('tenant/logout', [TenantLoginAuthController::class, 'logout'])->name('tenant.logout');

    Route::put('/settings/password', [TenantLoginAuthController::class, 'updatePassword'])->name('tenant.password.update');



    Route::get('/dashboard', function () {
        $tenant = tenant();
        return view('tenant.dashboard', compact('tenant'));
    })->name('tenant.dashboard');

    Route::get('/settings', function () {
        $tenant = tenant();
        return view('tenant.settings', compact('tenant'));
    })->name('tenant.settings');
    

    
    Route::get('/', function () {                       //display medicine and tenant
        $tenant = tenant(); 
        $medicines = Medicine::all(); 
        return view('tenant.tenant', [
            'tenant' => $tenant, 
            'medicine' => $medicines, 
        ]);
    })->name('tenants.tenants');
    

    
    Route::resource('/tenants/addMedicine', MedecineCRUDESController::class);               //Tenant medicine crudes (resource)



    Route::fallback(function () {
        return response('Tenant page not found.', 404);
    });
});
