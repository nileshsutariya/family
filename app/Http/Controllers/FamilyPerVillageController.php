<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FamilyPerVillageController extends Controller
{
    public function familybyvillage(Request $request)
    {
        $elders = User::where('elder', 'yes')->get();
    
        return view('admin.familypervillage', compact('elders'));
    }
    public function getLinkedRecords(Request $request)
    {
        $linkedRecords = User::where('elder_ph_no', $request->elder_ph_no)->get();

        return response()->json($linkedRecords);
    }
}
