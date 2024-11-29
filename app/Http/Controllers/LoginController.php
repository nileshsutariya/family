<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'ph_no' => 'required',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('ph_no', 'password');
        $ph_no = $request->ph_no;

        // if (Auth::attempt($credentials)) {
        //     $users = Auth::user();
        //     if ($users->role_type == '1' && $users->approve_status == '1') {
        //         return redirect()->route('admin.dashboard');
        //     } elseif($users->role_type == '0' && $users->approve_status == '1') {
        //         return redirect()->route('user.dashboard');
        //     }
        //     else{
        //         return redirect()->back()->with('error', 'Wait For Approval.');                                           
        //     }
        // }

        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
        
            if ($user->approve_status != '1') {
                return redirect()->route('login')->with('message', 'Wait For Approval.');
            }
        
            return $user->role_type == '1'
                ? redirect()->route('admin.dashboard')
                : redirect()->route('user.dashboard');
        }
        return redirect()->route('login')->with('message', 'Invalid credentials.');                                           
    }
    public function logout(Request $request)
    {
        if(Auth::logout()) {
            return redirect()->route('login');
        }
        else {
            return redirect()->back();
        }
    }
}
