<?php

namespace App\Http\Controllers;

use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VillageController extends Controller
{
    // public function getSuggestions(Request $request)
    // {
    //     $villages = Village::where('district_id', $request->district_id)
    //     ->where('taluka_id', $request->taluka_id)
    //     ->get();
    //     return response()->json($villages);
    //     // $villages = DB::table('village')
    //     //         ->join('taluka', 'village.taluka', '=', 'taluka.id')
    //     //         ->join('district', 'taluka.district', '=', 'district.id')
    //     //         ->select(
    //     //             'village.id as village_id', 'village.village as village_name',
    //     //             'taluka.id as taluka_id', 'taluka.taluka as taluka_name',
    //     //             'district.id as district_id', 'district.district as district_name'
    //     //         )
    //     //         ->get();
    // //     $villages = Village::where('taluka_id', $request->taluka_id)->get();

    // //     return response()->json($villages);
    // }

    // public function getSuggestions(Request $request)
    // {
    //      $districtId = $request->input('district');
    //      $talukaId = $request->input('taluka');
 
    //      $villages = Village::where('district', $districtId)
    //                         ->where('taluka', $talukaId)
    //                         ->get();
    //     // print_r($villages); die;
    //     return response()->json($villages);
    // }

    public function getVillages(Request $request)
    {
        $talukaId = $request->input('taluka');

        if ($talukaId) {
            $villages = Village::where('taluka', $talukaId)->get();

            return response()->json($villages);
        }

        return response()->json([]);
    }


}
