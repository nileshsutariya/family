<?php

namespace App\Http\Controllers;

use App\Models\BusinessCategory;
use Illuminate\Http\Request;

class BusinessCategoryController extends Controller
{
    public function getSuggestions(Request $request)
    {
        $query = $request->get('query'); 

        $suggestions = BusinessCategory::where('business_category', 'like', "{$query}%") 
                                // ->limit(10) 
                                ->pluck('business_category');

        return response()->json($suggestions);
    }
}
