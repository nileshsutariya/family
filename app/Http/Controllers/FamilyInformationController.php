<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FamilyInformationController extends Controller
{
    public function familyinfo(Request $request)
    {
        $village = $request->village;
        $district = $request->district;
        $taluka = $request->taluka;
    
        $users = User::where(function ($query) use ($village, $district, $taluka) {
            $query->where('v_village', $village)
                  ->where('v_district', $district)
                  ->where('v_taluka', $taluka);
        })
        ->get();
    
        return view('admin.familymember', compact('users', 'village', 'district', 'taluka'));
    }
    private function maskemail($email)
    {
        $parts = explode('@', $email);
        return str_repeat('*', strlen($parts[0]) - 2) . substr($parts[0], -2) . '@' . $parts[1];
    }
    private function maskphno($ph_no)
    {
        return substr($ph_no, 0, 3) . str_repeat('*', 6) . substr($ph_no, -1);
    }
}
