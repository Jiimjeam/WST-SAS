<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;


class TransactionCRUDES extends Controller
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
        //
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
    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'patient_name' => 'required|string|max:255',
        'age' => 'required|integer|min:0',
        'gender' => 'required|in:male,female,other',
        'description' => 'required|string',
        'medicine_given' => 'required|string|max:255',
        'quantity' => 'required|integer|min:1',
    ]);

    $transaction = Transaction::findOrFail($id);
    $transaction->update($validated);

    return redirect()->route('tenant.visit.logs')->with('success', 'Transaction updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $transaction = Transaction::findOrFail($id);
    $transaction->delete();

    return redirect()->route('tenant.visit.logs')->with('success', 'Transaction deleted successfully.');
}
}
