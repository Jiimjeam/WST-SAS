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

Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/dashboard', [AdminLoginController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/tenants', [AdminLoginController::class, 'AllTenants'])->name('admin.AllTenants');
Route::get('/admin/pendingTenants', [AdminLoginController::class, 'PendingTenants'])->name('admin.pendingTenants');
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::resource('/tenants', AdminCRUDE::class);

Route::post('/tenants/{id}/approve', [TenantController::class, 'approveTenant'])->name('tenants.approve');
Route::post('/tenants/{id}/reject', [TenantController::class, 'rejectTenant'])->name('tenants.reject');





foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        Route::get('/', function () {
            return view('welcome');
        });
    });
}



Route::middleware([IdentifyTenant::class])->group(function () {
    Route::get('/', function () {
        $tenant = app('currentTenant');

        // You can pass tenant data to view
        return view('tenant.tenant', ['tenant' => $tenant]);
    });
});








Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
