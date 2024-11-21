<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function getSuggestions(Request $request)
    {
        $query = $request->get('query'); 

        $suggestions = District::where('district', 'like', "{$query}%") 
                                ->limit(10) 
                                ->pluck('district');

        return response()->json($suggestions);
    }
}
