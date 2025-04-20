<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\MedecineCRUDESController;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Medicine;
use App\Models\FeatureSetting;
use App\Http\Controllers\TenantLoginAuthController;
use App\Http\Controllers\Admin_Tenant_CRUDES_Controller;
use OwenIt\Auditing\Models\Audit;
use App\Http\Controllers\FeatureSettingController;

use App\Http\Controllers\Tenant\TenantAdminController;
use App\Http\Controllers\Tenant\TenantUserController;


Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {


    Route::get('tenant/login', [TenantAdminController::class, 'loginPage'])->name('tenant.login');
    Route::post('tenant/login', [TenantLoginAuthController::class, 'login'])->name('tenant.login.submit');
    Route::post('tenant/logout', [TenantLoginAuthController::class, 'logout'])->name('tenant.logout');

    

    // Admin tenant
    Route::middleware(['auth', 'can:is-admin'])->group(function () {

        Route::get('/admin/tenant/dashboard', [TenantAdminController::class, 'TenanAdminDashbaord'])->name('tenant.admin.dashboard');
        Route::delete('/admin/tenant/logs/clear', [TenantAdminController::class, 'LogsClear'])->name('tenant.admin.logs.clear');
        Route::get('/admin/tenant/users', [TenantAdminController::class, 'Users'])->name('tenants.admin.users');
        Route::get('/admin/tenant/settings', [TenantAdminController::class, 'Settings'])->name('tenant.admin.settings');

        Route::resource('/admin/tenant/addUser', Admin_Tenant_CRUDES_Controller::class);

        Route::get('/admin/tenant/features', [FeatureSettingController::class, 'index'])->name('tenant.admin.features');
        Route::patch('/admin/tenant/features/{feature}/toggle', [FeatureSettingController::class, 'toggle'])->name('tenant.admin.feature.toggle');
    });



    // change pass for both tenant user and tenant admin
    Route::put('/settings/password', [TenantLoginAuthController::class, 'updatePassword'])->name('tenant.password.update');

    
    // User tenant
   Route::middleware(['auth'])->group(function () {

        Route::get('/dashboard', [TenantUserController::class, 'UserDashboard'])->name('tenant.dashboard');
        Route::get('/settings', [TenantUserController::class, 'UserSettings'])->name('tenant.settings');
        Route::get('/', [TenantUserController::class, 'UserMedicine'])->name('tenants.tenants');
        Route::resource('/tenants/addMedicine', MedecineCRUDESController::class);
});        


    Route::fallback(function () {
        return response('Tenant page not found.', 404);
    });
});
