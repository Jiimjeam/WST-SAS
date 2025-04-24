<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

}
