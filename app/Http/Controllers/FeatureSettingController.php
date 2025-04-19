<?php

namespace App\Http\Controllers;
use App\Models\FeatureSetting;
use Illuminate\Http\Request;

class FeatureSettingController extends Controller
{
    public function index()
    {
        $defaultFeatures = [
            'add_medicine',
            'update_medicine',
            'delete_medicine',
        ];

        // Loop through each default and ensure it exists
        foreach ($defaultFeatures as $featureName) {
            FeatureSetting::firstOrCreate(
                ['feature_name' => $featureName],
                ['is_enabled' => true] // or false if you want them off by default
            );
        }

        // Get all the features to pass to the view
        $features = FeatureSetting::all();

        return view('tenant.adminTenant.featureControl', compact('features'));
    }

    public function toggle(Request $request, FeatureSetting $feature)
        {
            $feature->update(['is_enabled' => !$feature->is_enabled]);
            return back()->with('success', 'Feature toggled successfully!');
        }
}
