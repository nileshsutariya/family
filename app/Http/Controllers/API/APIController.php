<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Events;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController;

class APIController extends BaseController
{
    
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
                $token = $users->createToken('login-token')->accessToken;
                $response = [
                    'user' => $users,
                    'token' => $token,
                    'message' => 'User logged in successfully'
                ];
                return response($response, 200);
            
            } elseif ($users->role_type == '0') {
                $token = $users->createToken('login-token')->accessToken;
                $response = [
                    'user' => $users,
                    'token' => $token,
                    'message' => 'User logged in successfully'
                ];
                return response($response, 200);
            } else {
                return redirect()->back()->withInput()->withErrors('error', 'Invalid credentials.');
            }
        }
    }
    public function display()
    {
        $users = Auth::user();
        if ($users) {
            return response()->json($users);
        }    
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json("logout");
    }
    public function viewevents(Request $request)
    {
        $events= Events::offset($request->start*$request->length)
                ->limit($request->length)
                ->leftJoin('users','users.id','=','events.organizer')
                ->select('events.*','users.first_name as organizer')
                ->get();
        if ($events->isEmpty()) {
            return $this->apierror(['error' => 'Event not found'], ['id_not_found' => true], 404);
        } 
        return $this->apisuccess($events, 'events list');
        
    }
    public function weeklyevents(Request $request)
    {
        $events = Events::offset($request->start*$request->length)
                ->limit($request->length)
                ->thisWeek()
                ->leftJoin('users','users.id','=','events.organizer')
                ->select('events.*','users.first_name as organizer')
                ->get();
        if ($events->isEmpty()) {
            return $this->apierror(['error' => 'Event not found'], ['id_not_found' => true], 404);
        }
        return $this->apisuccess($events, 'weekly events');
    }
}
