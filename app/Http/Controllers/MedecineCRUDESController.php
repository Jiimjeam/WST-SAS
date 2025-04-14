<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;

class MedecineCRUDESController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'medicine_name' => 'required|string|max:255|unique:medicines,medicine_name',
            'quantity' => 'required|integer|min:0',
        ]);

        Medicine::create($validated);
        return redirect()->route('tenants.tenants')->with('success', 'Medicine added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $medicine = Medicine::findOrFail($id);
        // return view('medicines.show', compact('medicine'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $medicine = Medicine::findOrFail($id);
        // return view('medicines.edit', compact('medicine'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'medicine_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:10',
        ]);

        $medicine = Medicine::findOrFail($id);
        $medicine->update($validated);

        return redirect()->route('tenants.tenants')->with('success', 'Medicine updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $medicine = Medicine::findOrFail($id);
        $medicine->delete();
        return redirect()->route('tenants.tenants')->with('success', 'Medicine deleted successfully.');
    }
}
