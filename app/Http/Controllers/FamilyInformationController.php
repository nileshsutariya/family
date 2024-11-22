<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FamilyInformationController extends Controller
{
    public function familyinfo($v_village)
    {
        $familyMembers = User::where('v_village', $v_village)->get();
        return view('admin.familymember', compact('familyMembers'));
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
