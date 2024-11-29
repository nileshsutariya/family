<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $members = User::count();
        $upcoming = Events::where('event_status',0)->count();
        $ongoing=Events::where('event_status',1)->count();
        $completed = Events::where('event_status',2)->count();
        $cancelled = Events::where('event_status',3)->count();
        $users = User::all();
        $events = Events::all();
        return view('admin.dashboard', compact('members','users', 'events','upcoming','ongoing','completed','cancelled'));
    }
    public function viewevent(Request $request)
    {
        if ($request->id) {
            $query = Events::where('id',$request->id)->first();
            if($query){
                if($query->event_status=="0") {
                    $query->event_status="1";
                } elseif($query->event_status=="1") {
                    $query->event_status="2";
                } else {
                    $query->event_status="3";
                }
                $query->save();

                return response()->json([
                    'event_status' => $query->event_status
                ]); 
            }
        }
        $users = User::paginate(10);
        $events= Events::leftJoin('users','users.id','=','events.organizer')->select('events.*','users.first_name as organizer')->with('organizer')->paginate(10);
        return view('admin.viewevents', compact('users', 'events'));
    }
    public function profile()
    {
        $users = Auth::user();
        return view('admin.profile', compact('users'));
    }
    public function updateprofile(Request $request)
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
        $users->marital_status = $request['marital_status'];
        $users->spouse_name = $request['spouse_name'];
        $users->email = $request['email'];
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
        return redirect()->route('admin.profile')->with('update', 'Profile Updated Successfully!!');
    }
    public function approval(Request $request)
    {
        $users = User::where('approve_status', 0)->get();
        if ($request->id) {
            $query = User::where('id',$request->id)->first();
            if($query){
                if($query->approve_status == "0") {
                    $query->approve_status = "1";
                }
                $query->save();

                return response()->json([
                    'approve_status' => $query->approve_status
                ]); 
            }
        }
        return view('admin.user-approval',compact('users'));
    }
}
