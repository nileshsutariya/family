<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FamilyPerVillageController extends Controller
{
    public function familybyvillage(Request $request)
    {
        $villages = User::select('v_village', 'v_district', 'v_taluka', DB::raw('count(*) as total'))
            ->groupBy('v_village', 'v_district', 'v_taluka') 
            ->get();
        
        foreach ($villages as $village) {
            $village->user_count = User::where('v_village', $village->v_village)->count();
        }

        return view('admin.familypervillage', compact('villages'));
    }
   
}
