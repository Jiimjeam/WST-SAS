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
            'email' => 'required|email|unique:tenants,email',
            'contactNumber' => 'required|string',
            'barangayName' => 'required|string',
        ]);

        // Generate the database name
        $databaseName = 'tenant_' . preg_replace('/[^a-z0-9_]+/i', '_', strtolower(str_replace(' ', '_', $request->name)));

        
        $tenant = Tenant::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact_number' => $request->contactNumber,
            'barangay_name' => $request->barangayName,
            'clinic_name' => $request->clinicName,
            'domain' => $request->domain,
            'database' => $databaseName,
            'status' => Tenant::STATUS_PENDING
        ]);

        
        $tenant->domains()->create([
            'domain' => $request->domain,
        ]);


        return redirect()->back()->with('success', "Tenant '{$tenant->domain}' registered and pending admin approval.");
    }




    public function approveTenant($id)
{
    $tenant = Tenant::findOrFail($id);
    $tenant->status = Tenant::STATUS_APPROVED;
    $tenant->save();

    // Create DB only after approval
    DB::statement("CREATE DATABASE IF NOT EXISTS `{$tenant->database}`");

    config([
        'database.connections.tenant' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => $tenant->database,
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
        ],
    ]);

    Artisan::call('migrate', [
        '--database' => 'tenant',
        '--path' => '/database/migrations/tenant',
        '--force' => true,
    ]);

    return redirect()->back()->with('success', "Tenant '{$tenant->domain}' approved and database created.");
}



public function rejectTenant($id)
{
    $tenant = Tenant::findOrFail($id);
    $tenant->status = Tenant::STATUS_REJECTED;
    $tenant->save();

    return redirect()->back()->with('info', "Tenant '{$tenant->domain}' has been rejected.");
}
}
