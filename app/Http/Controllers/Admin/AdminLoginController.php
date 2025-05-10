<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tenant;
use App\Models\UpgradeNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminLoginController extends Controller
{
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $admin = Admin::where('email', $request->email)->first();

    if ($admin && Hash::check($request->password, $admin->password)) {
        session(['admin_logged_in' => true]);
        return redirect()->route('admin.dashboard');
    }

    return redirect('/')->with('admin_error', 'Invalid admin credentials')->withInput();
}

  

    public function dashboard()
    {
        $acceptedCount = Tenant::where('status', 'accepted')->count();
        $pendingCount = Tenant::where('status', 'pending')->count();
        $rejectedCount = Tenant::where('status', 'rejected')->count();
        $totalTenants = Tenant::count();

        return view('adminPages.AdminDashboard', compact('acceptedCount', 'pendingCount', 'rejectedCount', 'totalTenants'));
    }   


    public function AllTenants()
        {
                $tenantList = Tenant::where('status', Tenant::STATUS_APPROVED)->get();
                return view ('adminPages.allTenants', 
                [
                    'tenantList' => $tenantList
                ]
            );
        }

        public function notifications()
        {
            $notifications = UpgradeNotification::orderBy('created_at', 'desc')->get();
            return view('adminPages.notifications', compact('notifications'));
        }

    public function PendingTenants()
        {
            $pendingTenantList = Tenant::where('status', Tenant::STATUS_PENDING)->get();
        
            return view('adminPages.pendingTenants', [
                'pendingTenantList' => $pendingTenantList
            ]);
        }
        

    public function logout()
        {
            session()->forget('admin_logged_in');
            return redirect()->route('admin.login');
        }

    
}
