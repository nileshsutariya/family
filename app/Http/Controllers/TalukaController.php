<?php

namespace App\Http\Controllers;

use App\Models\Taluka;
use App\Models\Village;
use Illuminate\Http\Request;

class TalukaController extends Controller
{
    // public function getSuggestions(Request $request)
    // {
    //     // $query = $request->get('query'); 

    //     // $suggestions = Taluka::where('taluka', 'like', "{$query}%") 
                                
    //     //                         // ->limit(10) 
    //     //                         ->pluck('taluka');
    //     if ($request->district_id) {
    //         // Fetch Talukas based on the district_id
    //         $talukas = Taluka::where('district_id', $request->district_id)->get();
            
    //         // Return the Talukas as JSON
    //         return response()->json($talukas);
    //     } else {
    //         return response()->json([], 400);  // Return empty array if district_id is not provided
    //     }
    // }

    // public function getTalukas(Request $request)
    // {
    //     $talukas = Taluka::where('district', $request->districtId)->get();
    //     return response()->json($talukas);
    // }
    public function getTalukas(Request $request)
    {
        $districtId = $request->input('district');
        if ($districtId) {
            $talukas = Taluka::where('district', $districtId)->get();

            return response()->json($talukas);
        }

        return response()->json([]);

        // $taluka = Taluka::where('district', $request->district)->get();
        // return response()->json($taluka);
    }

}
