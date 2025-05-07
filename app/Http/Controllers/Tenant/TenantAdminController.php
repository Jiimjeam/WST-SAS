<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tenant;
use App\Models\User;
use App\Models\Medicine;
use App\Models\FeatureSetting;
use OwenIt\Auditing\Models\Audit;

use App\Http\Controllers\GoogleCalendarController;

class TenantAdminController extends Controller
{
    public function loginPage()
    {
        return view('tenant.login');
    }   

    public function TenanAdminDashbaord()
    {
        $tenant = tenant();
            $logs = Audit::with('user')->latest()->limit(10)->get();
            $usersCount = User::count(); 
            $medicinesCount = Medicine::count(); 


            $defaultFeatures = [
                'add_medicine',
                'update_medicine',
                'delete_medicine',
            ];
    
            foreach ($defaultFeatures as $featureName) {
                FeatureSetting::firstOrCreate(
                    ['feature_name' => $featureName],
                    ['is_enabled' => true] 
                );
            }
    
            $features = FeatureSetting::all();

            return view('tenant.adminTenant.dashboard', compact('tenant', 'logs', 'usersCount', 'medicinesCount', 'features'));
    } 


    public function LogsClear()
    {
        Audit::truncate(); 
        return back()->with('success', 'All logs have been cleared.');
    } 


    public function Users()
    {
        $tenant = tenant(); 
        $users = User::all(); 
            return view('tenant.adminTenant.allUsers', [
                'tenant' => $tenant, 
                'user' => $users, 
            ]);
    } 



    public function Settings()
    {
        $tenant = tenant();
            return view('tenant.adminTenant.settings', compact('tenant'));
    } 


    public function calendar()
    {
        return view('adminPages.calendar');
    }
    

    

    
}
