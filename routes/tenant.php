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

use App\Http\Controllers\FeatureSettingController;

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
    Route::middleware(['auth', 'can:is-admin'])->group(function () {
    
        Route::get('/admin/tenant/dashboard', function () {
            $tenant = tenant();
            $logs = Audit::with('user')->latest()->limit(10)->get();
            $usersCount = User::count(); 
            $medicinesCount = Medicine::count(); 
            return view('tenant.adminTenant.dashboard', compact('tenant', 'logs', 'usersCount', 'medicinesCount'));
        })->name('tenant.admin.dashboard');
    
        Route::delete('/admin/tenant/logs/clear', function () {
            Audit::truncate(); // Clears all logs
            return back()->with('success', 'All logs have been cleared.');
        })->name('tenant.admin.logs.clear');
    
        Route::get('/admin/tenant/users', function () {
            $tenant = tenant(); 
            $users = User::all(); 
            return view('tenant.adminTenant.allUsers', [
                'tenant' => $tenant, 
                'user' => $users, 
            ]);
        })->name('tenants.admin.users');
    
        Route::get('/admin/tenant/settings', function () {
            $tenant = tenant();
            return view('tenant.adminTenant.settings', compact('tenant'));
        })->name('tenant.admin.settings');

        Route::resource('/admin/tenant/addUser', Admin_Tenant_CRUDES_Controller::class);


        Route::get('/admin/tenant/features', [FeatureSettingController::class, 'index'])->name('tenant.admin.features');
        Route::patch('/admin/tenant/features/{feature}/toggle', [FeatureSettingController::class, 'toggle'])->name('tenant.admin.feature.toggle');
    
    });



    Route::put('/settings/password', [TenantLoginAuthController::class, 'updatePassword'])->name('tenant.password.update');




    // User tenant
   Route::middleware(['auth'])->group(function () {

    // Display dashboard tab
    Route::get('/dashboard', function () {
        $tenant = tenant();
        return view('tenant.dashboard', compact('tenant'));
    })->name('tenant.dashboard');

    // Display settings tab
    Route::get('/settings', function () {
        $tenant = tenant();
        return view('tenant.settings', compact('tenant'));
    })->name('tenant.settings');

    // Display medicine and tenant overview
    Route::get('/', function () {
        $tenant = tenant();
        $medicines = Medicine::all();
        return view('tenant.tenant', [
            'tenant' => $tenant,
            'medicine' => $medicines,
        ]);
    })->name('tenants.tenants');
    
    // Tenant medicine CRUD routes with permissions
    Route::resource('/tenants/addMedicine', MedecineCRUDESController::class);
});        //Tenant medicine crudes (resource)






    Route::fallback(function () {
        return response('Tenant page not found.', 404);
    });
});
