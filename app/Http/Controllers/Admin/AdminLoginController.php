<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
  

    // Process login
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $adminEmail = 'limj1674@gmail.com';
    $adminPassword = '123123123';

    if ($request->email === $adminEmail && $request->password === $adminPassword) {
        session(['admin_logged_in' => true]);
        return redirect()->route('admin.dashboard');
    }

    return redirect('/')->with('admin_error', 'Invalid admin credentials')->withInput();
}

    // Show dashboard
    public function dashboard()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        return view('adminPages.AdminDashboard'); 
    }

    public function AllTenants()
        {
            return view('adminPages.allTenants');
        }

    public function PendingTenants()
        {
            return view('adminPages.pendingTenants');
        }

    public function logout()
        {
            session()->forget('admin_logged_in');
            return redirect()->route('admin.login');
        }

    
}
