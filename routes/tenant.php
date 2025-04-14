<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\MedecineCRUDESController;
use App\Models\Tenant;
use App\Models\Medicine;

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    
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
