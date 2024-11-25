<?php

namespace App\Http\Controllers;

use App\Models\Taluka;
use Illuminate\Http\Request;

class TalukaController extends Controller
{
    public function getSuggestions()
    {
        // $taluka = Taluka::all();
        // return view('register', compact('taluka'));  
        // $query = $request->get('query'); 

        // $suggestions = Taluka::where('taluka', 'like', "{$query}%") 
        //                         ->limit(10) 
        //                         ->pluck('taluka');

        // return response()->json($suggestions);
    }
}
