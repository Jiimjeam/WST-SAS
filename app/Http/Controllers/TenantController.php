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
        'domain' => 'required|string|max:255|unique:tenants,domain',
        'email' => 'required|email|unique:tenants,email',
        'contactNumber' => 'required|string',
        'barangayName' => 'required|string',
    ]);

    $fullDomain = "{$request->domain}.127.0.0.1.nip.io";

    // Step 1: Create the tenant with 'database' set as null
    $tenant = Tenant::create([
        'name' => $request->name,
        'email' => $request->email,
        'contact_number' => $request->contactNumber,
        'barangay_name' => $request->barangayName,
        'clinic_name' => $request->clinicName,
        'domain' => $fullDomain,
        'database' => null,  // Set database as null initially
        'status' => Tenant::STATUS_PENDING
    ]);

    // Step 2: Update the database field with the tenant's ID
    $tenant->database = 'tenant' . $tenant->id;
    $tenant->save();  // Save the updated tenant

    return redirect()->back()->with('success', "Tenant '{$tenant->domain}' registered and pending admin approval.");
}




    public function approveTenant($id)
    {
        $tenant = Tenant::findOrFail($id);
        $tenant->status = Tenant::STATUS_APPROVED;
        $tenant->save();
    
        // The package will automatically create the database when you create the domain
        $tenant->domains()->create([
            'domain' => $tenant->domain,
        ]);
    
        $password = Str::random(10);
    
        // Switch to tenant context to create the user
        tenancy()->initialize($tenant);
    
        $existingUser = \App\Models\User::where('email', $tenant->email)->first();
    
        if (!$existingUser) {
            \App\Models\User::create([
                'name' => $tenant->name,
                'email' => $tenant->email,
                'password' => bcrypt($password),
            ]);
    
            Mail::to($tenant->email)->send(new TenantApprovedMail($tenant, $password));
        }
    
        tenancy()->end();
    
        return redirect()->back()->with('success', "Tenant '{$tenant->domain}' approved and domain added.");
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
