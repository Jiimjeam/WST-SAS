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
    

    $tenant = Tenant::create([
        'name' => $request->name,
        'email' => $request->email,
        'contact_number' => $request->contactNumber,
        'barangay_name' => $request->barangayName,
        'clinic_name' => $request->clinicName,
        'domain' => $fullDomain,
        'database' => null,  
        'password' => null,  
        'status' => Tenant::STATUS_PENDING
    ]);

    $tenant->database = 'tenant' . $tenant->id;
    $tenant->save(); 

    return redirect()->back()->with('success', "Tenant '{$tenant->domain}' registered and pending admin approval.");
}





public function approveTenant($id)
{
    $tenant = Tenant::findOrFail($id);
    $tenant->status = Tenant::STATUS_APPROVED;

    $password = Str::random(5);
    $tenant->password = $password; 
    $tenant->save();

    $tenant->domains()->create([
        'domain' => $tenant->domain,
    ]);


    tenancy()->initialize($tenant);

    $existingUser = \App\Models\User::where('email', $tenant->email)->first();

    if (!$existingUser) {
        \App\Models\User::create([
            'name' => $tenant->name,
            'email' => $tenant->email,
            'password' => bcrypt($password),
        ]);
    }

    tenancy()->end();

    $loginUrl = url("http://{$tenant->domain}:8000/tenant/login");
    
    Mail::to($tenant->email)->send(new TenantApprovedMail($tenant, $password, $loginUrl));

    return redirect()->back()->with('success', "Tenant '{$tenant->domain}' approved, domain added, and welcome email sent.");
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
