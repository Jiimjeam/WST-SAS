<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

use App\Models\Tenant;

class TenantController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
    ]);

    // Check if email already exists in tenant data
    $existing = \App\Models\Tenant::all()->filter(function ($tenant) use ($request) {
        return $tenant->get('email') === $request->email;
    })->first();

    if ($existing) {
        throw ValidationException::withMessages([
            'email' => 'The email has already been taken.',
        ]);
    }

    $tenantId = strtolower(str_replace(' ', '_', $request->name));
    $databaseName = 'tenant_' . $tenantId;
    $domain = $tenantId . '.yourdomain.test';

    $tenant = \App\Models\Tenant::create([
        'id' => $tenantId,
        'data' => [
            'name' => $request->name,
            'email' => $request->email,
        ]
    ]);

    $tenant->domains()->create([
        'domain' => $domain,
    ]);

    // Create DB
    DB::statement("CREATE DATABASE IF NOT EXISTS `$databaseName`");

    // Set config
    config([
        'database.connections.tenant' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => $databaseName,
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
        ],
    ]);

    // Run tenant migrations
    Artisan::call('migrate', [
        '--database' => 'tenant',
        '--path' => '/database/migrations/tenant',
        '--force' => true,
    ]);

    return redirect()->back()->with('success', "Tenant registered and database '$databaseName' created.");
}
}
