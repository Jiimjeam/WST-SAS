<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

class TenantLoginAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        // Ensure tenant is initialized
        $tenant = tenant(); // From Stancl Tenancy helper
    
        if (!$tenant) {
            return back()->withErrors([
                'tenant' => 'Tenant context could not be determined. Please check your domain.',
            ]);
        }
    
        // Check if user exists within the tenant's users table
        $user = \App\Models\User::where('email', $credentials['email'])->first();
    
        if (!$user) {
            return back()->withErrors([
                'email' => 'No user found with that email on this tenant.',
            ]);
        }
    
        // Check password
        if (!\Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'password' => 'Incorrect password.',
            ]);
        }
    
        // Login the user
        Auth::login($user);
        $request->session()->regenerate();
    
        return redirect()->intended('/dashboard');
    }

    public function logout(Request $request)
    {
    Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('tenant.login.submit'); 
    }


    public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required'],
        'new_password' => ['required', 'min:8', 'confirmed'],
    ]);

    $user = auth()->user();

    if (!\Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'The current password is incorrect.']);
    }

    $user->password = bcrypt($request->new_password);
    $user->save();

    return back()->with('success', 'Password updated successfully.');
}

    
}
