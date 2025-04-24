<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function generatePDF()
        {
            $transactions = Transaction::all();
        
            $tenantName = tenant()->name ?? 'Unknown Tenant'; // Adjust based on how you access the tenant
        
            $pdf = Pdf::loadView('tenant.pdf', compact('transactions', 'tenantName'));
            return $pdf->download("transactions-report-{$tenantName}.pdf");
        }
    
}
