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
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        $email = $request->email;
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
