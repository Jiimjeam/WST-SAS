<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Middleware\IdentifyTenant;



use App\Http\Controllers\Admin\AdminCRUDE;

Route::post('/register-tenant', [TenantController::class, 'store'])->name('tenant.register');

Route::get('/admin/login', function () {
    return redirect('/')->with('showAdminLogin', true);
})->name('admin.login');

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        Route::get('/', function () {
            return view('welcome');
        })->name('welcome');
    });
}

Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/dashboard', [AdminLoginController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/tenants', [AdminLoginController::class, 'AllTenants'])->name('admin.AllTenants');
Route::get('/admin/pendingTenants', [AdminLoginController::class, 'PendingTenants'])->name('admin.pendingTenants');
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
Route::resource('/tenants', AdminCRUDE::class);
Route::post('/tenants/{id}/approve', [TenantController::class, 'approveTenant'])->name('tenants.approve');
Route::post('/tenants/{id}/reject', [TenantController::class, 'rejectTenant'])->name('tenants.reject');

Route::post('/tenants/{tenant}/disable', [TenantController::class, 'disable'])->name('tenants.disable');
Route::post('/tenants/{tenant}/activate', [TenantController::class, 'activate'])->name('tenants.activate');



Route::middleware([IdentifyTenant::class])->group(function () {
    Route::get('/', function () {
        $tenant = app('currentTenant');

        // You can pass tenant data to view
        return view('tenant.tenant', ['tenant' => $tenant]);
    });
});





require __DIR__.'/auth.php';
