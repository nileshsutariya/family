<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function getSuggestions(Request $request)
    {
        $query = $request->get('query'); 

        $suggestions = Company::where('company_name', 'like', "{$query}%") 
                                ->pluck('company_name');

        return response()->json($suggestions);
    }
}
