<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tenant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminLoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        $adminAccounts = [
            [
                'email' => 'limj1674@gmail.com',
                'password' => '123123123'
            ],
            [
                'email' => 'admin2@example.com',
                'password' => 'password2'
            ],
            [
                'email' => 'admin3@example.com',
                'password' => 'password3'
            ]
        ];
    
        foreach ($adminAccounts as $admin) {
            if ($request->email === $admin['email'] && $request->password === $admin['password']) {
                session(['admin_logged_in' => true]);
                return redirect()->route('admin.dashboard');
            }
        }
    
        return redirect('/')->with('admin_error', 'Invalid admin credentials')->withInput();
    }
    

  

    public function dashboard()
        {
            return view('adminPages.AdminDashboard'); 
        }

    public function AllTenants()
        {
                $tenantList = Tenant::all();
                return view ('adminPages.allTenants', 
                [
                    'tenantList' => $tenantList
                ]
            );
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
