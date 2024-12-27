<?php

namespace App\Http\Controllers;

use App\Models\Taluka;
use App\Models\Village;
use Illuminate\Http\Request;

class TalukaController extends Controller
{
    public function getTalukas(Request $request)
    {
        $districtId = $request->input('district');
        if ($districtId) {
            $talukas = Taluka::where('district', $districtId)->get();

            return response()->json($talukas);
        }

        return response()->json([]);

    }

}
