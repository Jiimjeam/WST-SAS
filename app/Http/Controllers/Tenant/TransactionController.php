<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patientName' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'gender' => 'required|in:male,female,other',
            'description' => 'required|string',
            'medicine' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        Transaction::create([
            'patient_name' => $validated['patientName'],
            'age' => $validated['age'],
            'gender' => $validated['gender'],
            'description' => $validated['description'],
            'medicine_given' => $validated['medicine'],
            'quantity' => $validated['quantity'],
        ]);

        return redirect()->back()->with('success', 'Transaction recorded successfully.');
    }
}
