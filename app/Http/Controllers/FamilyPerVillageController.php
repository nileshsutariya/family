<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FamilyPerVillageController extends Controller
{
    // public function familybyvillage(Request $request)
    // {
    //     $villages = User::select(
    //         'c_village', 
    //         'c_district', 
    //         'c_taluka', 
    //         'v_village', 
    //         'v_district', 
    //         'v_taluka', 
    //         DB::raw('count(*) as total'),

    //         // DB::raw('SUM(v_village IS NOT NULL) as village_user_count'),
    //         // DB::raw('SUM(c_village IS NOT NULL) as c_village_user_count')
    //     )
    //     ->groupBy(
    //         'v_village',
    //         'c_village', 'c_district' ,'c_taluka',
    //         'v_district', 'v_taluka')
    //     ->get();

    //     foreach ($villages as $village) {
    //         $village->village_user_count = User::where('v_village', $village->v_village)->count();
    //         $village->c_village_user_count = User::where('c_village', $village->c_village)->count();
    //     }

    //     return view('admin.familypervillage', compact('villages'));
    // }
   

    public function familybyvillage(Request $request)
    {
        $v_villages = User::select( 
            'v_village', 
            'v_district', 
            'v_taluka', 
            DB::raw('COUNT(DISTINCT IFNULL(elder_ph_no, ph_no)) as family_count'),
            DB::raw('count(*) as total'),
            DB::raw('SUM(v_village IS NOT NULL) as village_user_count'),
            DB::raw('GROUP_CONCAT(id) as user_id')
        )
        ->groupBy(
            'v_village', 
            'v_district', 'v_taluka')
        ->get();

        return view('admin.familypervillage', compact('v_villages'));
    }
}
