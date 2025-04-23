<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Models\Transaction;



class TenantUserController extends Controller
{
    public function UserDashboard()
    {
        $tenant = tenant();
        return view('tenant.dashboard', compact('tenant'));
    } 


    public function UserSettings()
    {
        $tenant = tenant();
            return view('tenant.settings', compact('tenant'));
    } 


    public function UserMedicine()
    {
        $tenant = tenant();
            $medicines = Medicine::all();
            return view('tenant.tenant', [
                'tenant' => $tenant,
                'medicine' => $medicines,
            ]);
    }



    public function transactionForm()
    {
        $tenant = tenant();
            return view('tenant.transaction', compact('tenant'));
    }


    public function visitLogs()
    {
        $transactions = Transaction::all(); 
        return view('tenant.visitLogs', [
            'transactions' => $transactions, 
        ]);
    }



}
