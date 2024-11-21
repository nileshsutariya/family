<?php

namespace App\Http\Controllers;

use App\Models\Village;
use Illuminate\Http\Request;

class VillageController extends Controller
{
    public function getSuggestions(Request $request)
    {
        $query = $request->get('query'); 

        $suggestions = Village::where('village', 'like', "{$query}%") 
                                ->limit(10) 
                                ->pluck('village');

        return response()->json($suggestions);
    }
}
