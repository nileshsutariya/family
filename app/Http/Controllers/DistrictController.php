<?php

namespace App\Http\Controllers;

use App\Models\Taluka;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function getDistricts()
    {
        $districts = District::all();
        return view('register', compact('districts'));
    }
}
