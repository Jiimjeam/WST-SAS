<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminCRUDE extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
        {
            $viewTenant = Tenant::findOrFail($id);

            
            return response()->json([
                'tenant' => $viewTenant
            ]);
        }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'clinic_name' => 'required|string|max:255',
            'email' => 'required|email',
            'contact_number' => 'required|string|max:20',
            'barangay_name' => 'required|string|max:255',
            'domain' => 'required|string|max:255',
        ]);
    
        $tenant = Tenant::findOrFail($id);
    
        $tenant->update([
            'name' => $request->name,
            'clinic_name' => $request->clinic_name,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'barangay_name' => $request->barangay_name,
            'domain' => $request->domain,
        ]);
    
        return redirect()->back()->with('success', 'Tenant updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tenant = Tenant::findOrFail($id);

        // Delete the tenant record
        $tenant->delete();
    
        return redirect()->back()->with('success', 'Tenant and associated database deleted successfully!');
    }
    
}
