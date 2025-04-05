<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TenantController extends Controller
{
        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:tenants,email',
            ]);
        
            $tenantId = strtolower(str_replace(' ', '_', $request->name));
            $domain = $tenantId . '.yourdomain.com';
        
            $tenant = Tenant::create([
                'id' => $tenantId,
                'name' => $request->name,
                'email' => $request->email,
                'domain' => $domain,
            ]);
        
            $tenant->domains()->create(['domain' => $domain]);
        
            // Create the tenant's database
            Artisan::call('tenants:create', [
                'tenant' => $tenantId
            ]);
        
            return redirect()->back()->with('success', 'Tenant registered!');
        }

}
