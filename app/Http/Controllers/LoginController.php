<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Taluka;
use App\Models\Village;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\LazyCollection;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'ph_no' => 'required|string|regex:/^\+?[0-9]{10,15}$/',
            'password' => 'required|string',
        ], [
            'ph_no.required' => 'The phone number is required.',                                                         
            'ph_no.regex' => 'The phone number must be 10 to 15 digits.',
        ]);
    
        $credentials = $request->only('ph_no', 'password');
    
        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
    
            if ($admin->approve_status == '1') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->back()->with('error', 'Admin approval is pending.');
            }
        }
    
        if (Auth::guard('web')->attempt($credentials)) {
            $users = Auth::guard('web')->user();
    
            if ($users->approve_status == '1') {
                return redirect()->route('user.dashboard');
            } else {
                return redirect()->back()->with('error', 'User approval is pending.');
            }
        }
    
        if (User::where('ph_no', $request->ph_no)->doesntExist() &&
            Admin::where('ph_no', $request->ph_no)->doesntExist()) {
            return redirect()->route('login')->with('message', 'Phone number does not exist.');
        }
    
        return redirect()->route('login')->with('message', 'Incorrect password.');
    }
    
    public function logout(Request $request)
    {
        if (Auth::guard('web')->logout()) {
            return redirect()->route('login');
        } elseif (Auth::guard('admin')->logout()) {
            return redirect()->route('login');
        } else {
            return redirect()->back();
        }
    }

    public function test()
    {
        LazyCollection::make(function () {
            $handle = fopen(public_path('area.csv'), 'r');
            while (($row = fgets($handle)) !== false) {
                yield str_getcsv($row);
            }
        })
        // ->map(function ($log){
        //     // print_r($log);die;
        //     return [
        //         'district' => $log[0],
        //         'taluka' => $log[1],
        //         'village' => $log[2],
        //     ];
        // })
        ->filter(function ($log) {
            return $log[0] != 'Kachchh' && $log[0] != 'Banas Kantha' && $log[0] != 'Patan' && $log[0] != 'Mahesana' && $log[0] != 'Gandhinagar' && $log[0] != 'Ahmadabad' && $log[0] != 'Surendranagar' && $log[0] != 'Rajkot' && $log[0] != 'Jamnagar' && $log[0] != 'Porbandar' && $log[0] != 'Junagadh' && $log[0] != 'Amreli' && $log[0] != 'Bhavnagar' && $log[0] != 'Anand' && $log[0] != 'Kheda' && $log[0] != 'Panch Mahals' && $log[0] != 'Dohad' && $log[0] != 'Vadodara' && $log[0] != 'Narmada' && $log[0] != 'Bharuch' && $log[0] != 'The Dangs' && $log[0] != 'Navsari' && $log[0] != 'Valsad';
        })
        // ->chunk(20)
        ->each(function ($row){
            // print_r($row);
            $district = District::where('district',$row[0])->first();
            if(!$district){
                $district = new District;
                $district->district = $row[0];
                $district->save();
            }

            $taluka = Taluka::where('district',$district->id)->where('taluka',$row[1])->first();
            
            if(!$taluka){
                $taluka = new Taluka;
                $taluka->taluka = $row[1];
                $taluka->district = $district->id;
                $taluka->save();
            }


            $village = Village::where('district',$district->id)->where('taluka',$taluka->id)->where('village',$row[2])->first();
            if(!$village){
                $village = new Village;
                $village->village = $row[2];
                $village->taluka = $taluka->id;
                $village->district = $district->id;
                $village->save();
            }

        });
    }
}
