<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\MedecineCRUDESController;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Medicine;

use App\Http\Controllers\TenantLoginAuthController;
use App\Http\Controllers\Admin_Tenant_CRUDES_Controller;

use OwenIt\Auditing\Models\Audit;

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

    

    // Admin tenant
    Route::get('/admin/tenant/dashboard', function () {                 //display 'tenant', 'logs', 'usersCount', 'medicinesCount' data
        $tenant = tenant();
        $logs = Audit::with('user')->latest()->limit(10)->get();
        $usersCount = \App\Models\User::count(); 
        $medicinesCount = \App\Models\Medicine::count(); 
        return view('tenant.adminTenant.dashboard', compact('tenant', 'logs', 'usersCount', 'medicinesCount'));
    })->name('tenant.admin.dashboard');



    Route::delete('/admin/tenant/logs/clear', function () {
        Audit::truncate(); // Clears all logs
        return back()->with('success', 'All logs have been cleared.');
    })->name('tenant.admin.logs.clear');




    Route::get('/admin/tenant/users', function () {                       //display all users
        $tenant = tenant(); 
        $users = User::all(); 
        return view('tenant.adminTenant.allUsers', [
            'tenant' => $tenant, 
            'user' => $users, 
        ]);
    })->name('tenants.admin.users');

    Route::get('/admin/tenant/settings', function () {                   //display settings tab
        $tenant = tenant();
        return view('tenant.adminTenant.settings', compact('tenant'));
    })->name('tenant.admin.settings');

    Route::resource('/admin/tenant/addUser', Admin_Tenant_CRUDES_Controller::class);       




    // User tenant
    Route::get('/dashboard', function () {                  //display dashbaord tab
        $tenant = tenant();
        return view('tenant.dashboard', compact('tenant'));
    })->name('tenant.dashboard');

    Route::get('/settings', function () {                   //display settings tab
        $tenant = tenant();
        return view('tenant.settings', compact('tenant'));
    })->name('tenant.settings');

    Route::put('/settings/password', [TenantLoginAuthController::class, 'updatePassword'])->name('tenant.password.update');
    
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
