<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;


class TenantSettingsController extends Controller
{
    public function updateSidebarColor(Request $request)
{
    $request->validate([
        'color' => 'required|string|max:7',
    ]);

    $user = auth()->user();
    $user->sidebar_color = $request->color;
    $user->save();

    return response()->json(['success' => true]);
}

public function updateSidebarTextColor(Request $request)
{
    $request->validate([
        'color' => 'required|string|max:7',
    ]);

    $user = auth()->user();
    $user->text_color = $request->color;
    $user->save();

    return response()->json(['success' => true]);
}


public function updateSidebarButtonColor(Request $request)
{
    $request->validate([
        'color' => 'required|string|max:7',
    ]);

    $user = auth()->user();
    $user->Logoutbutton_color = $request->color;
    $user->save();

    return response()->json(['success' => true]);
}



public function updateFont(Request $request)
{
    $request->validate([
        'font_family' => 'required|string|max:255',
    ]);

    $user = auth()->user();
    $user->font_family = $request->font_family;
    $user->save();

    return redirect()->back()->with('success', 'Font updated successfully!');
}


public function sidebarIs(Request $request)
{
    $request->validate([
        'sidebar_is' => 'required|string|max:255',
    ]);

    $user = auth()->user();
    $user->sidebar_is = $request->sidebar_is;
    $user->save();

    return redirect()->back()->with('success', 'Sidebar updated successfully!');
}




public function ResetDefaultCustomUI(Request $request)
{
    $user = auth()->user();
    $user->sidebar_color = null; 
    $user->text_color = null;   
    $user->Logoutbutton_color = null; 
    $user->font_family = null; 
    $user->sidebar_is = null; 
    $user->save();

    return redirect()->back()->with('success', 'Settings have been reset to default!');
}




public function uploadPicture(Request $request)
{
    $request->validate([
        'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = Auth::user();

    // Delete old picture if exists
    if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
        Storage::disk('public')->delete($user->profile_picture);
    }

    // Store new picture in 'public/profile_pictures'
    $path = $request->file('profile_picture')->store('profile_pictures', 'public');

    // Save path to DB
    $user->profile_picture = $path;
    $user->save();
    

    return back()->with('success', 'Profile picture updated successfully!');
}






}
