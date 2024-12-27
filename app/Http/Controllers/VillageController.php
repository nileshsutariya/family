<?php

namespace App\Http\Controllers;

use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VillageController extends Controller
{

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
