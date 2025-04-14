<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Validation\ValidationException;
use App\Models\Tenant;
use App\Models\Medicine;

use Illuminate\Support\Facades\Mail;
use App\Mail\TenantApprovedMail;
use Illuminate\Support\Str;


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

       
        $subdomain = preg_replace('/[^a-z0-9]+/i', '', strtolower($request->domain));
        $fullDomain = "{$subdomain}.127.0.0.1.nip.io";
       
        $databaseName = 'tenant_' . preg_replace('/[^a-z0-9_]+/i', '_', strtolower(str_replace(' ', '_', $request->name)));

        $tenant = Tenant::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact_number' => $request->contactNumber,
            'barangay_name' => $request->barangayName,
            'clinic_name' => $request->clinicName,
            'domain' => $fullDomain, 
            'database' => $databaseName,
            'status' => Tenant::STATUS_PENDING
        ]);

       
        $tenant->domains()->create([
            'domain' => $fullDomain,
        ]);

        return redirect()->back()->with('success', "Tenant '{$tenant->domain}' registered and pending admin approval.");
    }







    public function approveTenant($id)
    {
        $tenant = Tenant::findOrFail($id);
        $tenant->status = Tenant::STATUS_APPROVED;
        $tenant->save();
    
        // Create DB
        DB::statement("CREATE DATABASE IF NOT EXISTS `{$tenant->database}`");
    
        // Set connection config
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
    
        // Run migrations
        Artisan::call('migrate', [
            '--database' => 'tenant',
            '--path' => '/database/migrations/tenant',
            '--force' => true,
        ]);
    
        // Generate password
        $password = Str::random(10);
    
        // Check if user exists
        $existingUser = DB::connection('tenant')->table('users')->where('email', $tenant->email)->first();
    
        if (!$existingUser) {
            DB::connection('tenant')->table('users')->insert([
                'name' => $tenant->name,
                'email' => $tenant->email,
                'password' => bcrypt($password),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            // ✅ Send email
            Mail::to($tenant->email)->send(new TenantApprovedMail($tenant, $password));
        }
    
        return redirect()->back()->with('success', "Tenant '{$tenant->domain}' approved.");
    }




    public function rejectTenant($id)
    {
        $tenant = Tenant::findOrFail($id);
        $tenant->status = Tenant::STATUS_REJECTED;
        $tenant->save();

        $tenant->delete();

        return redirect()->back()->with('info', "Tenant '{$tenant->id}' has been rejected and deleted.");
    }
}
