<?php

declare(strict_types=1);
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\MedecineCRUDESController;
use App\Models\Tenant;


$tenant = Tenant::where('domain', request()->getHost())->first();

if ($tenant && $tenant->statusAorD === 'disabled') {
    Route::get('{any?}', function () use ($tenant) {
        return response()->view('errors.tenant-disabled', ['tenant' => $tenant], 403);
    })->where('any', '.*');
    
    return; 
}


use App\Models\User;
use App\Models\Medicine;
use App\Models\FeatureSetting;
use App\Http\Controllers\TenantLoginAuthController;
use App\Http\Controllers\Admin_Tenant_CRUDES_Controller;
use OwenIt\Auditing\Models\Audit;
use App\Http\Controllers\FeatureSettingController;

use App\Http\Controllers\Tenant\TenantAdminController;
use App\Http\Controllers\Tenant\TenantUserController;

use App\Http\Controllers\Tenant\TransactionController;


Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
    'can:check-tenant-statusAorD',
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
        Route::get('/Transaction/form', [TenantUserController::class, 'transactionForm'])->name('tenant.transaction');
        Route::get('/visit/logs', [TenantUserController::class, 'visitLogs'])->name('tenant.visit.logs');

        Route::post('/transactions/store', [TransactionController::class, 'store'])->name('transactions.store');
        


        Route::get('/transactions/pdf', [TransactionController::class, 'generatePDF'])->name('tenant.transactions.pdf');

        Route::resource('/tenants/addMedicine', MedecineCRUDESController::class);
});        


    Route::fallback(function () {
        return response('Tenant page not found.', 404);
    });
});
