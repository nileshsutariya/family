<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\User;
use Illuminate\Http\Request;

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
        $users = User::all();
        $events= Events::leftJoin('users','users.id','=','events.organizer')->select('events.*','users.first_name as organizer')->with('organizer')->get();
        return view('admin.viewevents', compact('users', 'events'));
    }
    
    public function familyinfo()
    {
        return view('admin.familymember');
    }
    public function profile()
    {
        return view('admin.profile');
    }
}
