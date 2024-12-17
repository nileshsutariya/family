<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function create()
    {
        $users = User::all();
        return view('admin.add-event',['mode' => 'add'], compact('users'));
    }
    public function eventstore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'event_date' => 'required',
            'event_time' => 'required',
            'event_address' => 'required',
            'organizer' => 'required',
            'event_status' => 'required'
        ])->validate();
        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->messages()], 422);
        // }

        $events= new Events();
        $events->title = $request['title'];
        $events->event_date = $request['event_date'];
        $events->event_time = $request['event_time'];
        $events->address = $request['event_address'];
        $events->organizer = $request['organizer'];

        if($banner=$request->file('banner')){;
            $imagename= $banner->getClientOriginalName();
            $imagepath='public/image';
            $banner->move($imagepath,$imagename);
            $events->banner=$imagename;
        } else {
            $imagename = null;
        }
        $events->event_status = $request['event_status'];
        $events->notes = $request['notes'];
        $events->save();
        $url=$request->url();
        if (strpos($url, 'api') == true) {
            return response()->json("event stored successfully!"); 
        } else {
            return redirect()->route('view.events')->with('store', 'Event Stored Successfully!!');
        }    
    }
    public function delete($id)
    {
        $events= Events::find($id)->delete();
        return redirect()->back()->with('delete', 'Event Deleted Successfully!');
    }
    public function edit($id)
    {
        $users = User::all();
        $events = Events::find($id);
        return view("admin.add-event",['mode' => 'edit'],compact('events', 'users'));
    }
    public function update(request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'event_address' => 'required',
            'organizer' => 'required',
            'event_status' => 'required'
        ])->validate();
        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->messages()], 422);
        // }

        $events = Events::find($id); 
        $users = User::all();

        $events->title = $request['title'];
        $events->event_date = $request['event_date'];
        $events->event_time = $request['event_time'];
        $events->address = $request['event_address'];
        $events->organizer = $request['organizer'];
        $events->notes = $request['notes'];
        if($banner=$request->file('banner')) {
            $imagename= $banner->getClientOriginalName();
            $imagepath='public/image/';
            $banner->move($imagepath,$imagename);
            $events->banner=$imagename;
        } else {
            $imagename = null;
        }
        $events->event_status = $request['event_status'];
        $events->save();
        return redirect()->route('view.events')->with('update', 'Event Updated Successfully!!');
    }
    public function eventstatus(Request $request)
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
    }
}
