<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function getSuggestions(Request $request)
    {
        $query = $request->get('query'); 

        $suggestions = Education::where('education', 'like', "{$query}%") 
                                ->pluck('education');
                                
        if ($suggestions->isEmpty()) {
            return response()->json([]);
        }
                            
        return response()->json($suggestions);
    }
}
