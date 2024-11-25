<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Village;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Events;
use App\Models\Taluka;
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
        $district = District::all();
        $taluka = Taluka::all();
        $village = Village::all();
        return view('register', compact('district', 'taluka', 'village'));
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

        $rootUser = User::where('ph_no', $request->ph_no)->first();
        
        if (!$rootUser) {
            $rootUser = User::where('ph_no', $request->elder_ph_no)->first();
        }
        
        $parentid = $rootUser ? $rootUser->id : null;
        
        $users = User::updateOrCreate(
            ['ph_no' => $request->ph_no], 
            [
                'elder' => $request->elder,
                'elder_ph_no' => $request->elder_ph_no,
                'ph_no' => $request->ph_no,
                'password' => Hash::make($request->password),
                'first_name' => $request->first_name,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'last_name' => $request->last_name,
                'marital_status' => $request->marital_status,
                'spouse_name' => $request->spouse_name,
                'email' => $request->email,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'blood_group' => $request->blood_group,
                'c_address' => $request->c_address,
                'c_district' => $request->c_district,
                'c_taluka' => $request->c_taluka,
                'c_village' => $request->c_village,
                'v_address' => $request->v_address,
                'v_district' => $request->v_district,
                'v_taluka' => $request->v_taluka,
                'v_village' => $request->v_village,
                'education' => $request->education,
                'profession' => $request->profession,
                'company_name' => $request->company_name,
                'business_category' => $request->business_category,
                'parent_id' => $parentid,
            ]
        );
        return redirect()->route('login')->with('store', 'Registration successful!');            
    }
    public function delete($id)
    {
        $users= User::find($id)->delete();
        return redirect()->back()->with('delete', 'User Deleted Successfully!');
    }
    public function edit($id)
    {
        $users = User::find($id);
        return view("user.editmember",compact('users'));
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
            'ph_no' => 'required|string',
            'first_name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'last_name' => 'required',
            'marital_status' => 'required',
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

        $users = User::find($request->id); 
        // print_r($users); die;
        $users->first_name = $request['first_name'];
        $users->father_name = $request['father_name'];
        $users->mother_name = $request['mother_name'];
        $users->last_name = $request['last_name'];
        $users->ph_no = $request['ph_no'];
        $users->marital_status = $request['marital_status'];
        $users->email = $request['email'];
        $users->gender = $request['gender'];
        $users->date_of_birth = $request['date_of_birth'];
        $users->blood_group = $request['blood_group'];
        $users->c_address = $request['c_address'];
        $users->c_district = $request['c_district'];
        $users->c_taluka = $request['c_taluka'];
        $users->c_village = $request['c_village'];
        $users->v_address = $request['v_address'];
        $users->v_district = $request['v_district'];
        $users->v_taluka = $request['v_taluka'];
        $users->v_village = $request['v_village'];
        $users->education = $request['education'];
        $users->profession = $request['profession'];
        $users->company_name = $request['company_name'];
        $users->business_category = $request['business_category'];
        
        $users->save();

        return redirect()->route('family.user')->with('update', 'User Updated Successfully!!');
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
        $users->father_name = $request['father_name'];
        $users->mother_name = $request['mother_name'];
        $users->last_name = $request['last_name'];
        $users->ph_no = $request['ph_no'];
        $users->date_of_birth = $request['date_of_birth'];
        $users->blood_group = $request['blood_group'];
        $users->gender = $request['gender'];
        $users->c_address = $request['c_address'];
        $users->c_district = $request['c_district'];
        $users->c_taluka = $request['c_taluka'];
        $users->c_village = $request['c_village'];
        $users->v_address = $request['v_address'];
        $users->v_district = $request['v_district'];
        $users->v_taluka = $request['v_taluka'];
        $users->v_village = $request['v_village'];
        $users->education = $request['education'];
        $users->profession = $request['profession'];
        $users->company_name = $request['company_name'];
        $users->business_category = $request['business_category'];
        $users->save();
        return redirect()->route('profile')->with('update', 'User Updated Successfully!!');
    }
    public function userview()
    {
        $user = Auth::user();
        $phone = $user->ph_no;

        $visitedPhones = [];
        $relatedPhones = [];

        $findRelatedPhones = function ($phone) use (&$visitedPhones, &$relatedPhones, &$findRelatedPhones) {
            if (in_array($phone, $visitedPhones)) {
                return;
            }

            $visitedPhones[] = $phone;

            $directMembers = User::where('ph_no', $phone)
                                ->orWhere('elder_ph_no', $phone)
                                ->get();

            foreach ($directMembers as $member) {
                if (!in_array($member->ph_no, $relatedPhones) && $member->role_type != '1') {
                    $relatedPhones[] = $member->ph_no; 
                    $findRelatedPhones($member->ph_no); 
                }
                if (!in_array($member->elder_ph_no, $relatedPhones) && $member->elder_ph_no != NULL) {
                    $relatedPhones[] = $member->elder_ph_no;
                    $findRelatedPhones($member->elder_ph_no); 
                }
            }
        };

        $findRelatedPhones($phone);

        $members = User::whereIn('ph_no', $relatedPhones)
                    ->orWhereIn('elder_ph_no', $relatedPhones)
                    ->get();

        return view('user.members', compact('members'));
    }

    // public function checkAndDeleteUnmatchedSpouse()
    // {
    //     // Retrieve all female users (assuming a gender column with 'female' as a value)
    //     $femaleUsers = User::where('gender', 'female')->get();

    //     // Loop through each female user
    //     foreach ($femaleUsers as $female) {
    //         $spouseName = $female->spouse_name;

    //         // Check if the spouse_name exists in the first_name field of any other user
    //         $spouseExists = User::where('first_name', $spouseName)->exists();

    //         // If no matching first_name is found for the spouse, delete the female user record
    //         if (!$spouseExists) {
    //             $female->delete();
    //         }
    //     }

    //     return response()->json(['message' => 'Unmatched spouse records have been checked and deleted if needed.']);
    // }

}
