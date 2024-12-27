<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
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
        $users = User::all();
        return view('user.dashboard', compact('users', 'upcoming', 'ongoing', 'completed', 'cancelled'));
    }
    public function register(Request $request)
    {
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

        return view('register', compact( 'users', 'districts', 'talukas', 'villages', 'education', 'business_category'));
    }
    public function store(Request $request)
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
            'document_type' => 'required|string',
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
        
        $c_district_name = District::where('id', $request->c_district)->value('district');
        $c_taluka_name = Taluka::where('id', $request->c_taluka)->value('taluka');
        $c_village_name = Village::where('id', $request->c_village)->value('village');
        $v_district_name = District::where('id', $request->v_district)->value('district');
        $v_taluka_name = Taluka::where('id', $request->v_taluka)->value('taluka');
        $v_village_name = Village::where('id', $request->v_village)->value('village');    

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
                'c_district' => $c_district_name,
                'c_taluka' => $c_taluka_name,
                'c_village' => $c_village_name,
                'v_address' => $request->v_address,
                'v_district' => $v_district_name,
                'v_taluka' => $v_taluka_name,
                'v_village' => $v_village_name,
                'education' => $request->education,
                'profession' => $request->profession,
                'company_name' => $request->company_name,
                'business_category' => $request->business_category,
                'profile_photo' => $profilePhotoName,
                'document_type' => $request->document_type,
                'document_upload' => $documentUploadName,
                'parent_id' => $parentid,
            ]
        );
        $url = $request->url();
        if (strpos($url, 'api') == true) {
            $response = [
                'status' => 200,
                'message' => 'User Registered Successfully',
                'data' => $users,
            ];
            return response($response, 200);        
        } else {
            return redirect()->route('login')->with('store', 'Registration Successful!!');
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
        $cDistricts = District::all();

        $selectedCDistrictName = $users->c_district; 
        $cDistrict = District::where('district', $selectedCDistrictName)->first();

        if ($cDistrict) {
            $cTalukas = Taluka::where('district', $cDistrict->id)->get();
        } else {
            $cTalukas = collect(); 
        }

        $selectedCTalukaName = $users->c_taluka; 
        $cTaluka = Taluka::where('taluka', $selectedCTalukaName)
                        ->where('district', $cDistrict ? $cDistrict->id : null)
                        ->first();

        if ($cTaluka) {
            $cVillages = Village::where('taluka', $cTaluka->id)
                                ->where('district', $cDistrict ? $cDistrict->id : null)
                                ->paginate(100);
        } else {
            $cVillages = collect(); 
        }

        $vDistricts = District::all();
        $selectedVDistrictName = $users->v_district; 
        $vDistrict = District::where('district', $selectedVDistrictName)->first();

        if ($vDistrict) {
            $vTalukas = Taluka::where('district', $vDistrict->id)->get();
        } else {
            $vTalukas = collect(); 
        }

        $selectedVTalukaName = $users->v_taluka; 
        $vTaluka = Taluka::where('taluka', $selectedVTalukaName)
                        ->where('district', $vDistrict ? $vDistrict->id : null)
                        ->first();

        if ($vTaluka) {
            $vVillages = Village::where('taluka', $vTaluka->id)
                                ->where('district', $vDistrict ? $vDistrict->id : null)
                                ->paginate(100);
        } else {
            $vVillages = collect(); 
        }

        $education = Education::all();
        $business_category = BusinessCategory::all();
        return view('user.editmember',compact('users','cDistricts','cTalukas','cVillages','vDistricts','vTalukas','vVillages','education','business_category'));
    }
    public function update(Request $request)
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

        $cDistrictName = District::find($request->c_district)->district ?? null;
        $cTalukaName = Taluka::find($request->c_taluka)->taluka ?? null;
        $cVillageName = Village::find($request->c_village)->village ?? null;
    
        $vDistrictName = District::find($request->v_district)->district ?? null;
        $vTalukaName = Taluka::find($request->v_taluka)->taluka ?? null;
        $vVillageName = Village::find($request->v_village)->village ?? null;

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
        $users->c_district = $cDistrictName; 
        $users->c_taluka = $cTalukaName;    
        $users->c_village = $cVillageName;  
        $users->v_address = $request['v_address'];
        $users->v_district = $vDistrictName; 
        $users->v_taluka = $vTalukaName;    
        $users->v_village = $vVillageName; 
        $users->education = $request['education'];
        $users->profession = $request['profession'];
        $users->company_name = $request['company_name'];
        $users->business_category = $request['business_category'];
        
        $users->save();

        return redirect()->route('family.user')->with('update', 'User Updated Successfully!!');
    }

    // public function view()
    // {
    //     $users = User::all();
    //     $events= Events::leftJoin('users','users.id','=','events.organizer')->select('events.*','users.first_name as organizer')->get();
    //     return view('admin.users', compact('users', 'events'));
    // }

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
        $users = User::paginate(10);
        $events = Events::thisWeek()->leftJoin('users','users.id','=','events.organizer')->select('events.*','users.first_name as organizer')->paginate(10);
        return view('user.viewevents', compact('users', 'events'));
    }
    public function profile()
    {
        $users = User::find(auth()->id()); 
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
    
        $cDistricts = District::all();

        $selectedCDistrictName = auth()->user()->c_district; 
        $cDistrict = District::where('district', $selectedCDistrictName)->first();

        if ($cDistrict) {
            $cTalukas = Taluka::where('district', $cDistrict->id)->get();
        } else {
            $cTalukas = collect(); 
        }

        $selectedCTalukaName = auth()->user()->c_taluka; 
        $cTaluka = Taluka::where('taluka', $selectedCTalukaName)
                        ->where('district', $cDistrict ? $cDistrict->id : null)
                        ->first();

        if ($cTaluka) {
            $cVillages = Village::where('taluka', $cTaluka->id)
                                ->where('district', $cDistrict ? $cDistrict->id : null)
                                ->paginate(100);
        } else {
            $cVillages = collect(); 
        }

        $vDistricts = District::all();
        $selectedVDistrictName = auth()->user()->v_district; 
        $vDistrict = District::where('district', $selectedVDistrictName)->first();

        if ($vDistrict) {
            $vTalukas = Taluka::where('district', $vDistrict->id)->get();
        } else {
            $vTalukas = collect(); 
        }

        $selectedVTalukaName = auth()->user()->v_taluka; 
        $vTaluka = Taluka::where('taluka', $selectedVTalukaName)
                        ->where('district', $vDistrict ? $vDistrict->id : null)
                        ->first();

        if ($vTaluka) {
            $vVillages = Village::where('taluka', $vTaluka->id)
                                ->where('district', $vDistrict ? $vDistrict->id : null)
                                ->paginate(100);
        } else {
            $vVillages = collect(); 
        }

        return view('user.profile', compact(
            'cDistricts','vDistricts',
            'cTalukas', 'cVillages', 'cDistrict', 'cTaluka',
            'vTalukas', 'vVillages', 'vDistrict', 'vTaluka', 'users', 'user',
        ));

    }
    public function profileupdate(Request $request)
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
            'ph_no.regex' => 'The phone number must be exactly 10 digits.',
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
        $cDistrictName = District::find($request->c_district)->district ?? null;
        $cTalukaName = Taluka::find($request->c_taluka)->taluka ?? null;
        $cVillageName = Village::find($request->c_village)->village ?? null;
    
        $vDistrictName = District::find($request->v_district)->district ?? null;
        $vTalukaName = Taluka::find($request->v_taluka)->taluka ?? null;
        $vVillageName = Village::find($request->v_village)->village ?? null;
    
        $users->first_name = $request['first_name'];
        $users->father_name = $request['father_name'];
        $users->mother_name = $request['mother_name'];
        $users->last_name = $request['last_name'];
        $users->ph_no = $request['ph_no'];
        $users->date_of_birth = $request['date_of_birth'];
        $users->blood_group = $request['blood_group'];
        $users->marital_status = $request['marital_status'];
        $users->spouse_name = $request['spouse_name'];
        $users->email = $request['email'];
        $users->gender = $request['gender'];
        $users->c_address = $request['c_address'];
        $users->c_district = $cDistrictName; 
        $users->c_taluka = $cTalukaName;    
        $users->c_village = $cVillageName;  
        $users->v_address = $request['v_address'];
        $users->v_district = $vDistrictName; 
        $users->v_taluka = $vTalukaName;    
        $users->v_village = $vVillageName; 
        $users->education = $request['education'];
        $users->profession = $request['profession'];
        $users->company_name = $request['company_name'];
        $users->business_category = $request['business_category'];
        $users->save();
        return redirect()->route('profile')->with('update', 'Profile Updated Successfully!!');
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
                if (!in_array($member->ph_no, $relatedPhones) && $member->approve_status == 1) {
                    $relatedPhones[] = $member->ph_no;
                    $findRelatedPhones($member->ph_no);
                }
                if (!in_array($member->elder_ph_no, $relatedPhones) && $member->elder_ph_no != NULL && $member->approve_status == 1) {
                    $relatedPhones[] = $member->elder_ph_no;
                    $findRelatedPhones($member->elder_ph_no);
                }
            }
        };
    
        $findRelatedPhones($phone);
    
        $members = User::whereIn('ph_no', $relatedPhones)
                        ->orWhereIn('elder_ph_no', $relatedPhones)
                        ->where('approve_status', 1) 
                        ->paginate(10);
    
        return view('user.members', compact('members'));
    }
    
    public function updateProfilePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $users = Auth::guard('web')->user();
        $file = $request->file('profile_photo');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('profile'), $fileName);

        if ($users->profile_photo && file_exists(public_path('profile/' . $users->profile_photo))) {
            unlink(public_path('profile/' . $users->profile_photo));
        }

        $users->profile_photo = $fileName;
        $users->save();

        return response()->json(['success' => true, 'image_url' => asset('profile/' . $fileName)]);
    }
    public function familymembers()
    {
        $authuser = Auth::user();
        $users = User::where('last_name', $authuser->last_name)
                ->where('approve_status', 1) 
                ->get();

        return view('user.allmembers', compact('users'));

    }
    public function membersbyvillage(Request $request)
    {
        $search = $request->input('search');

        if ($request->ajax()) {
            $users = User::when($search, function ($query, $search) {
                    return $query->where('first_name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%")
                                ->orWhere('ph_no', 'like', "%{$search}%");
                })
                ->paginate(10);

            return response()->json([
                'html' => view('user.partial', compact('users'))->render(),
                'pagination' => (string) $users->links('pagination::bootstrap-5'),
            ]);
        }
        
        $authuser = Auth::user();
        $users = User::where('v_village', $authuser->v_village)
                ->where('v_district', $authuser->v_district)
                ->where('v_taluka', $authuser->v_taluka)
                ->where('approve_status', 1) 
                ->get();

        return view('user.familybyvillage', compact('users'));
    }
    public function memberview($id)
    {
        $users = User::findOrFail($id);
        return view('user.particularuser', compact('users'));
    }
    public function allmembers(Request $request)
    {
        $search = $request->input('search');

        if ($request->ajax()) {
            $users = User::when($search, function ($query, $search) {
                    return $query->where('first_name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%")
                                ->orWhere('ph_no', 'like', "%{$search}%");
                })
                ->paginate(10);

            return response()->json([
                'html' => view('user.partial', compact('users'))->render(),
                'pagination' => (string) $users->links('pagination::bootstrap-5'),
            ]);
        }

        $users = User::all();
        return view('user.allmembers', compact('users'));
    }

    public function removeProfilePhoto(Request $request)
    {
        $user = Auth::guard('web')->user();
        if ($user) {
            $user->profile_photo = null; 
            $user->save();
        }

        return back()->with('success', 'Profile photo removed successfully.');
    }
}
