<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $upcoming = Events::thisWeek()
            ->leftJoin('users','users.id','=','events.organizer')
            ->select('events.*','users.first_name as organizer')
            ->where('event_status',0)
            ->count();
        $ongoing=Events::thisweek()
            ->leftJoin('users','users.id','=','events.organizer')
            ->select('events.*','users.first_name as organizer')
            ->where('event_status',1)
            ->count();
        $completed = Events::thisweek()
            ->leftJoin('users','users.id','=','events.organizer')
            ->select('events.*','users.first_name as organizer')
            ->where('event_status',2)
            ->count();
        $cancelled = Events::thisweek()
            ->leftJoin('users','users.id','=','events.organizer')
            ->select('events.*','users.first_name as organizer')
            ->where('event_status',3)
            ->count();
        return view('user.dashboard', compact('upcoming', 'ongoing', 'completed', 'cancelled'));
    }
    public function register()
    {
        return view('register');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users|email',
            'phone_no' => 'required|numeric',
            'address' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'password' => 'required',
            'confirmpassword' => 'required|same:password',
        ])->validate();
        $parentid = null;

        $rootUser = User::where('first_name', $request->middle_name)
                    ->orWhere(function($query) use ($request) {
                        $query->where('first_name', $request->first_name)
                            ->where('middle_name', $request->middle_name)
                            ->whereNull('parent_id');
                    })->first();

        $parentid = $rootUser ? $rootUser->id : null;

        $users = new User;
        $users->first_name = $request->first_name;  
        $users->middle_name = $request->middle_name;
        $users->last_name = $request->last_name;     
        $users->email = $request->email;           
        $users->phone_no = $request->phone_no;        
        $users->address = $request->address;          
        $users->date_of_birth = $request->date_of_birth;        
        $users->gender = $request->gender;            
        $users->password = Hash::make($request->password); 
        $users->parent_id = $parentid;                
        $users->save();  
        $url=$request->url();
        if (strpos($url, 'api') == true) {
            $token = $users->createToken('register-token')->accessToken;
            $message="register successfully";
            $response = [
                'user' => $users,
                'token' => $token,
                'message'=>$message
            ];
            return response($response,201); 
        } else {
            return redirect()->route('login')->with('store', 'Registration successful!');
        }                    
    }
    public function delete($id)
    {
        $users= User::find($id)->delete();
        return redirect()->back()->with('delete', 'User Deleted Successfully!');
    }
    public function edit($id)
    {
        $users = User::find($id);
        return view("admin.users",compact('users'));
    }
    public function update(Request $request)
    {
        $users = User::find($request->id); 
        $users->first_name = $request['first_name'];
        $users->middle_name = $request['middle_name'];
        $users->last_name = $request['last_name'];
        $users->email = $request['email'];
        $users->address = $request['address'];
        $users->phone_no = $request['phone_no'];
        $users->save();

        return redirect()->route('view.members')->with('update', 'User Updated Successfully!!');
    }
    public function view()
    {
        $users = User::all();
        $events= Events::leftJoin('users','users.id','=','events.organizer')->select('events.*','users.first_name as organizer')->get();
        return view('admin.users', compact('users', 'events'));
    }
    private function maskEmail($email)
    {
        $parts = explode('@', $email);
        return str_repeat('*', strlen($parts[0]) - 2) . substr($parts[0], -2) . '@' . $parts[1];
    }
    private function maskPhone($phone)
    {
        return substr($phone, 0, 3) . str_repeat('*', 6) . substr($phone, -1);
    }
    public function viewevent()
    {
        $users = User::all();
        $events = Events::thisWeek()->leftJoin('users','users.id','=','events.organizer')->select('events.*','users.first_name as organizer')->get();
        return view('user.viewevents', compact('users', 'events'));
    }
    public function profile()
    {
        $users = Auth::user();
        return view('user.profile', compact('users'));
    }
    public function profileupdate(Request $request)
    {
        $users = Auth::user();
        // $validatedData = $request->validate([
        //     'current_password' => 'required|string',
        //     'new_password' => 'required|string|confirmed',
        // ]);
        $users->first_name = $request['first_name'];
        $users->middle_name = $request['middle_name'];
        $users->last_name = $request['last_name'];
        $users->email = $request['email'];
        $users->phone_no = $request['phone_no'];
        $users->address = $request['address'];
        $users->date_of_birth = $request['date_of_birth'];
        $users->gender = $request['gender'];
        // $users->password = Hash::make($validatedData['new_password']);
        $users->save();
        return redirect()->route('profile')->with('update', 'User Updated Successfully!!');
    }
}
