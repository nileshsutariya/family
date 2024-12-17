<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Events;
use App\Models\Taluka;
use App\Models\Village;
use App\Models\District;
use App\Models\Education;
use Illuminate\Http\Request;
use App\Models\BusinessCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Auth::user();
        $members = User::count();
        $upcoming = Events::where('event_status',0)->count();
        $ongoing=Events::where('event_status',1)->count();
        $completed = Events::where('event_status',2)->count();
        $cancelled = Events::where('event_status',3)->count();
        $users = User::all();
        $events = Events::all();
        return view('admin.dashboard', compact('admin','members','users', 'events','upcoming','ongoing','completed','cancelled'));
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
        $admin = Auth::user();
        $users = DB::table('users')
            ->leftJoin('district as cd', 'cd.id', '=', 'users.c_district')
            ->leftJoin('taluka as ct', 'ct.id', '=', 'users.c_taluka')
            ->leftJoin('village as cv', 'cv.id', '=', 'users.c_village')
            ->leftJoin('district as vd', 'vd.id', '=', 'users.v_district')
            ->leftJoin('taluka as vt', 'vt.id', '=', 'users.v_taluka')
            ->leftJoin('village as vv', 'vv.id', '=', 'users.v_village')
            ->select(
                'users.*',
                'cd.district as c_district_name',
                'ct.taluka as c_taluka_name',
                'cv.village as c_village_name',
                'vd.district as v_district_name',
                'vt.taluka as v_taluka_name',
                'vv.village as v_village_name'
            )
            ->get();
    
        $districts = District::all();
        $talukas = Taluka::all();
        $villages = Village::limit(100)->get();
        $education = Education::all();
        $business_category = BusinessCategory::all();
        
        return view('admin.profile', compact('admin', 'districts', 'talukas', 'villages', 'education', 'business_category', 'users'));
    }
    public function updateprofile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'id' => 'required|exists:users,id',
            'ph_no' => 'required|string|regex:/^\+?[0-9]{10,15}$/',
            'first_name' => 'required|alpha',
            'father_name' => 'required|alpha',
            'mother_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'marital_status' => 'required',
            'spouse_name' => 'nullable|required_if:marital_status,married|string',
            'email' => 'nullable|email',
            'gender' => 'required',
            'date_of_birth' => 'nullable|date',
            'blood_group' => 'required',
            'c_address' => 'required|string',
            'c_district' => 'required',
            'c_taluka' => 'required',
            'c_village' => 'required',
            'v_address' => 'required|string',
            'v_district' => 'required',
            'v_taluka' => 'required',
            'v_village' => 'required',
            'education' => 'nullable',
            'profession' => 'required',
            'company_name' => 'nullable|required_if:profession,job,business|string',
            'business_category' => 'nullable',
        ],
        [
            'elder_ph_no.required' => 'The elder phone number is required.',
            'elder_ph_no.regex' => 'The elder phone number must be digits.',
            'ph_no.required' => 'The phone number is required.',
            'ph_no.regex' => 'The phone number must be 10 digits.',
            'c_address' => 'The current address is required.',
            'c_district' => 'The current district is required.',
            'c_taluka' => 'The current taluka is required.',
            'c_village' => 'The current village is required.',
            'v_address' => 'The village address is required.',
            'v_district' => 'The village district is required.',
            'v_taluka' => 'The village taluka is required.',
            'v_village' => 'The village name is required.',
        ])->validate();

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
    
    public function updateProfilePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $admin = Auth::guard('admin')->user();
        $file = $request->file('profile_photo');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('profile'), $fileName);

        if ($admin->profile_photo && file_exists(public_path('profile/' . $admin->profile_photo))) {
            unlink(public_path('profile/' . $admin->profile_photo));
        }

        $admin->profile_photo = $fileName;
        $admin->save();

        return response()->json(['success' => true, 'image_url' => asset('profile/' . $fileName)]);
    }
    public function approval(Request $request)
    {
        $admin = Auth::user();
        $district = District::all();
        $taluka = Taluka::all();
        $village = Village::all();
        $education = Education::all();
        $business_category = BusinessCategory::all();
        $users = User::where('approve_status', 0)->get();
           
        // if ($request->id) {
        //     $query = User::where('id',$request->id)->first();
        //     if($query){
        //         if($query->approve_status == "0") {
        //             $query->approve_status = "1";
        //         }
        //         $query->save();

        //         return response()->json([
        //             'approve_status' => $query->approve_status
        //         ]); 
        //     }
        // }
        return view('admin.user-approval',compact('users', 'admin', 'district', 'taluka', 'village', 'education', 'business_category'));
    
    }
    public function viewapproval($id)
    {
        $users = User::findOrFail($id);
        $admin = Auth::user();
        $district = District::all();
        $taluka = Taluka::all();
        $village = Village::all();
        $education = Education::all();
        $business_category = BusinessCategory::all();
        return view('admin.view-approval', compact('users', 'admin', 'district', 'taluka', 'village', 'education', 'business_category'));
    }
    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->approve_status = 1;
        $user->save();

        return redirect()->route('user-approval')->with('success', 'User has been approved!');
    }

    public function disapprove($id)
    {
        $user = User::findOrFail($id);
        $user->approve_status = 2;
        $user->save();

        return redirect()->route('user-approval')->with('error', 'User has been disapproved!');
    }

    public function addadmin()
    {
        return view('admin.add-admin');
    }
    public function storeaddadmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'elder' => 'required|in:yes,no',
            'elder_ph_no' => 'nullable|required_if:elder,no|string|regex:/^[0-9]{10}$/',
            'ph_no' => 'required|string|regex:/^[0-9]{10}$/',
            'password' => 'required|string|min:6',
            'first_name' => 'required|alpha',
            'father_name' => 'required|alpha',
            'mother_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'marital_status' => 'required',
            'spouse_name' => 'nullable|alpha|required_if:marital_status,married|string',
            'email' => 'nullable|email',
            'gender' => 'required',
            'date_of_birth' => 'required|date',
            'blood_group' => 'required',
            'c_address' => 'required|string',
            'c_district' => 'required',
            'c_taluka' => 'required',
            'c_village' => 'required',
            'v_address' => 'required|string',
            'v_district' => 'required',
            'v_taluka' => 'required',
            'v_village' => 'required',
            'education' => 'required',
            'profession' => 'required',
            'company_name' => 'nullable|required_if:profession,job,business|string',
            'business_category' => 'required',
            'profile_photo' => 'nullable|file|mimes:jpeg,jpg,png',
            'document' => 'required|string',
            'document_upload' => 'required|file|mimes:pdf,jpeg,jpg,png',
            'parent_id' => 'nullable'
        ],
        [
            'elder_ph_no.required' => 'The elder phone number is required.',
            'elder_ph_no.regex' => 'The elder phone number must be digits.',
            'ph_no.required' => 'The phone number is required.',
            'ph_no.regex' => 'The phone number must be 10 digits.',
            'c_address' => 'The current address is required.',
            'c_district' => 'The current district is required.',
            'c_taluka' => 'The current taluka is required.',
            'c_village' => 'The current village is required.',
            'v_address' => 'The village address is required.',
            'v_district' => 'The village district is required.',
            'v_taluka' => 'The village taluka is required.',
            'v_village' => 'The village name is required.',
        ])->validate();

        $parentid = null;

        $rootUser = User::where('ph_no', $request->ph_no)->first();
        
        if (!$rootUser) {
            $rootUser = User::where('ph_no', $request->elder_ph_no)->first();
        }
        
        $parentid = $rootUser ? $rootUser->id : null;

        if ($request->hasFile('profile_photo')) {
            $profilePhoto = $request->file('profile_photo');
            $profilePhotoName = time() . '_profile_' . $profilePhoto->getClientOriginalName();
            $profilePhotoPath = '/profile';
            $profilePhoto->move(public_path($profilePhotoPath), $profilePhotoName);
        } else {
            $profilePhotoName = null;
        }
        
        if ($request->hasFile('document_upload')) {
            $documentUpload = $request->file('document_upload');
            $documentUploadName = time() . '_document_' . $documentUpload->getClientOriginalName();
            $documentUploadPath = '/documents';
            $documentUpload->move(public_path($documentUploadPath), $documentUploadName);
        } else {
            $documentUploadName = null;
        }
        
        $admin = Admin::updateOrCreate(
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
                'profile_photo' => $profilePhotoName,
                'document' => $request->document,
                'document_upload' => $documentUploadName,
                'parent_id' => $parentid,
            ]
        );
        return redirect()->route('login')->with('store', 'Registration Successful!!'); 
    }
    public function allusers(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->input('search');
            $users = User::where('first_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('ph_no', 'like', "%{$search}%")
                        ->paginate(10);

            return response()->json([
                'html' => view('admin.partial', compact('users'))->render(),
                'pagination' => (string) $users->links('pagination::bootstrap-5'),
            ]);
        }

        $users = User::paginate(10);
        return view('admin.allusers', compact('users'));
    }
    
    // public function searchusers(Request $request)
    // {
    //     $query = User::query();

    //     if ($request->has('search') && $request->search) {
    //         $query->where('first_name', 'like', '%' . $request->search . '%')
    //             ->orWhere('last_name', 'like', '%' . $request->search . '%');
    //     }

    //     $users = $query->paginate(10);

    //     return view('admin.allusers', compact('users'));
    // }

    public function deletemember($id)
    {
        $users= User::find($id)->delete();
        return redirect()->back()->with('delete', 'User Deleted Successfully!');
    }
    public function editmember($id)
    {
        $users = User::find($id);
        $user = DB::table('users')
            ->leftJoin('district as cd', 'cd.id', '=', 'users.c_district')
            ->leftJoin('taluka as ct', 'ct.id', '=', 'users.c_taluka')
            ->leftJoin('village as cv', 'cv.id', '=', 'users.c_village')
            ->leftJoin('district as vd', 'vd.id', '=', 'users.v_district')
            ->leftJoin('taluka as vt', 'vt.id', '=', 'users.v_taluka')
            ->leftJoin('village as vv', 'vv.id', '=', 'users.v_village')
            ->select(
                'users.*',
                'cd.district as c_district_name',
                'ct.taluka as c_taluka_name',
                'cv.village as c_village_name',
                'vd.district as v_district_name',
                'vt.taluka as v_taluka_name',
                'vv.village as v_village_name'
            )
            ->get();

        $districts = District::all();
        $talukas = Taluka::all();
        $villages = Village::limit(100)->get();
        $education = Education::all();
        $business_category = BusinessCategory::all();
        return view('admin.editmembers',compact('user', 'users','districts','talukas','villages','education','business_category'));
    }
    public function updatemember(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
            'ph_no' => 'required|string|regex:/^[0-9]{10}$/',
            'first_name' => 'required|alpha',
            'father_name' => 'required|alpha',
            'mother_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'marital_status' => 'required',
            'spouse_name' => 'nullable|required_if:marital_status,married|string',
            'email' => 'nullable|email',
            'gender' => 'required',
            'date_of_birth' => 'nullable|date',
            'blood_group' => 'required',
            'c_address' => 'required|string',
            'c_district' => 'required',
            'c_taluka' => 'required',
            'c_village' => 'required',
            'v_address' => 'required|string',
            'v_district' => 'required',
            'v_taluka' => 'required',
            'v_village' => 'required',
            'education' => 'nullable',
            'profession' => 'required',
            'company_name' => 'nullable|required_if:profession,job,business|string',
            'business_category' => 'nullable',
            'parent_id' => 'nullable'
        ],
        [
            'elder_ph_no.required' => 'The elder phone number is required.',
            'elder_ph_no.regex' => 'The elder phone number must be digits.',
            'ph_no.required' => 'The phone number is required.',
            'ph_no.regex' => 'The phone number must be 10 digits.',
            'c_address' => 'The current address is required.',
            'c_district' => 'The current district is required.',
            'c_taluka' => 'The current taluka is required.',
            'c_village' => 'The current village is required.',
            'v_address' => 'The village address is required.',
            'v_district' => 'The village district is required.',
            'v_taluka' => 'The village taluka is required.',
            'v_village' => 'The village name is required.',
        ])->validate();

        $users = User::find($request->id); 
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

        return redirect()->back()->with('update', 'User Updated Successfully!!');
        // return redirect()->route('family.village')->with('update', 'User Updated Successfully!!');
    }
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->input('query');

            $users = User::where('first_name', 'like', '%' . $query . '%')
                ->orWhere('father_name', 'like', '%' . $query . '%')
                ->orWhere('last_name', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%')
                ->orWhere('ph_no', 'like', '%' . $query . '%')
                ->get();
                
                return view('admin.familypartial', compact('users', 'query'));
        }
    }
    public function memberview($id)
    {
        $users = User::findOrFail($id);
        return view('admin.particularuserview', compact('users'));
    }
}
