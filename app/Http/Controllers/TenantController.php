<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Validation\ValidationException;


use App\Models\Tenant;

class TenantController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'domain' => 'required|string|max:255|unique:domains,domain',
        'email' => 'required|email',
        'contactNumber' => 'required|string',
        'barangayName' => 'required|string',
    ]);

    $existing = Tenant::whereJsonContains('data->email', $request->email)->first();
    if ($existing) {
        throw ValidationException::withMessages([
            'email' => 'The email has already been taken.',
        ]);
    }

    $tenant = Tenant::create([
        'data' => [
            'name' => $request->name,
            'email' => $request->email,
            'contactNumber' => $request->contactNumber,
            'barangayName' => $request->barangayName,
        ],
        
    ]);

    $tenant->domains()->create(['domain' => $request->domain]);

    $databaseName = 'tenant_' . preg_replace('/[^a-z0-9_]+/i', '_', strtolower(str_replace(' ', '_', $request->name)));

    DB::statement("CREATE DATABASE IF NOT EXISTS `$databaseName`");

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

    try {
        Artisan::call('migrate', [
            '--database' => 'tenant',
            '--path' => '/database/migrations/tenant',
            '--force' => true,
        ]);
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['migration' => 'Migration failed: ' . $e->getMessage()]);
    }

    // Optional: Save DB name in data
    $tenant->update([
        'data' => array_merge($tenant->data ?? [], ['database' => $databaseName])  // Ensure data is an array
    ]);


    return redirect()->back()->with('success', "Tenant '{$tenant->domain}' registered with database '$databaseName' created.");
}
}
