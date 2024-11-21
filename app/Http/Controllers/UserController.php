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
            'elder' => 'required|in:yes,no',
            'elder_ph_no' => 'nullable|string',
            'ph_no' => 'required|string',
            'password' => 'required',
            'first_name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'last_name' => 'required',
            'marital_status' => 'required',
            'spouse_name' => 'nullable',
            'email' => 'nullable',
            'gender' => 'required',
            'date_of_birth' => 'nullable',
            'blood_group' => 'required',
            'c_address' => 'required',
            'c_district' => 'required',
            'c_taluka' => 'required',
            'c_village' => 'required',
            'v_address' => 'required',
            'v_district' => 'required',
            'v_taluka' => 'required',
            'v_village' => 'required',
            'education' => 'nullable',
            'profession' => 'required',
            'company_name' => 'nullable',
            'business_category' => 'nullable',
            'parent_id' => 'nullable'
        ])->validate();

        $parentid = null;

        $rootUser = User::where('ph_no', $request->ph_no)
                    ->orWhere(function($query) use ($request) {
                        $query->where('ph_no', $request->ph_no)
                            ->where('elder_ph_no', $request->ph_no)
                            ->whereNull('parent_id');
                    })->first();

        $parentid = $rootUser ? $rootUser->id : null;

        $users = new User;
        $users->elder = $request->elder;
        // $elder_ph_no = $request->input('elder_ph_no');        
        $users->elder_ph_no = $request->elder_ph_no;        
        // $ph_no = $request->input('ph_no');
        $users->ph_no = $request->ph_no;
        $users->password = Hash::make($request->password); 
        $users->first_name = $request->first_name;
        $users->father_name = $request->father_name;
        $users->mother_name = $request->mother_name;
        $users->last_name = $request->last_name;
        $users->marital_status = $request->marital_status;
        $users->spouse_name = $request->spouse_name;
        $users->email = $request->email;
        $users->gender = $request->gender;
        $users->date_of_birth = $request->date_of_birth;
        $users->blood_group = $request->blood_group;
        $users->c_address = $request->c_address;
        $users->c_district = $request->c_district;
        $users->c_taluka = $request->c_taluka;
        $users->c_village = $request->c_village;
        $users->v_address = $request->v_address;
        $users->v_district = $request->v_district;
        $users->v_taluka = $request->v_taluka;
        $users->v_village = $request->v_village;
        $users->education = $request->education;
        $users->profession = $request->profession;
        $users->company_name = $request->company_name;
        $users->business_category = $request->business_category;
        $users->parent_id = $parentid;
        // dd($users); die;
        $users->save();
        return redirect()->route('login')->with('store', 'Registration successful!');

        // $url=$request->url();
        // if (strpos($url, 'api') == true) {
        //     $token = $users->createToken('register-token')->accessToken;
        //     $message="register successfully";
        //     $response = [
        //         'user' => $users,
        //         'token' => $token,
        //         'message'=>$message
        //     ];
        //     return response($response,201); 
        // } else {
        //     return redirect()->route('login')->with('store', 'Registration successful!');
        // }                    
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
        $users->first_name = $request['first_name'];
        $users->middle_name = $request['middle_name'];
        $users->last_name = $request['last_name'];
        $users->email = $request['email'];
        $users->phone_no = $request['phone_no'];
        $users->address = $request['address'];
        $users->date_of_birth = $request['date_of_birth'];
        $users->gender = $request['gender'];
        $users->save();
        return redirect()->route('profile')->with('update', 'User Updated Successfully!!');
    }
}
