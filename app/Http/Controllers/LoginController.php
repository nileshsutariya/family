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
        if (Auth::attempt($credentials)) {
            $users = Auth::user();
            if ($users->role_type == '1') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }
        return redirect()->back()->withInput()->withErrors('error', 'Invalid credentials.');                                           
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
