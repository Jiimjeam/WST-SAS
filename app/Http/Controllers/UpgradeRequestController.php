<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpgradeRequestController extends Controller
{
    public function notifyAdmin(Request $request)
{
    // Send a notification to your central admin app here
    // This can be a stored DB record, email, broadcast, webhook, etc.

    // Example: dispatch job, send webhook, or log
    // Http::post('https://central-app.com/api/notify-upgrade', [...]);

    return response()->json(['status' => 'success']);
}
}
