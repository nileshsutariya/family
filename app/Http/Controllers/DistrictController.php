<?php

namespace App\Http\Controllers;

use App\Models\Taluka;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    // public function getSuggestions(Request $request)
    // {
    //     if ($request->district_id) {
    //         // Fetch the Taluka data based on the selected district_id
    //         $talukas = Taluka::where('district_id', $request->district_id)->get();
    //         return response()->json($talukas);
    //     }
    //     // $query = $request->get('query'); 

    //     // $districts = District::where('district', 'like', "{$query}%") 
    //     //                         // ->limit(10) 
    //     //                         ->pluck('district');

    //     // return response()->json($districts);
    // }
    public function getDistricts()
    {
        $district = District::all();
        return view('register', compact('district'));
    }
}
