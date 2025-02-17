<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Admin;
use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;

class APIController extends BaseController
{
    public function login(Request $request)
    {
        $request->validate([
            'ph_no' => 'required|string|regex:/^\+?[0-9]{10,15}$/',
            'password' => 'required|string',
        ], [
            'ph_no.required' => 'The phone number is required.',
            'ph_no.regex' => 'The phone number must be 10 to 15 digits.',
            'password.required' => 'The password is required.',
        ]);

        $credentials = $request->only('ph_no', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
        
            if ($admin->approve_status == '1') {
                $token = $admin->createToken('login-token')->accessToken;
                return response()->json([
                    'user' => $admin,
                    'token' => $token,
                    'message' => 'Admin logged in successfully',
                ], 200);
            } else {
                return response()->json([
                    'error' => 'Admin approval is pending.',
                ], 403);
            }
        }
        

        if (Auth::guard('web')->attempt($credentials)) {
            $users = Auth::guard('web')->user();

            if ($users->approve_status == '1') {
                $token = $users->createToken('login-token')->accessToken;
                $response = [
                    'user' => $users,
                    'token' => $token,
                    'message' => 'User logged in successfully'
                ];
                return response($response, 200);
            } else {
                return response()->json([
                    'error' => 'User approval is pending.',
                ], 403);
            }
        }

        if (User::where('ph_no', $request->ph_no)->doesntExist() &&
            Admin::where('ph_no', $request->ph_no)->doesntExist()) {
            return response()->json([
                'error' => 'Phone number does not exist.',
            ], 404);
        }

        return response()->json([
            'error' => 'Incorrect password.',
        ], 401);
    }

    public function display(Request $request)
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
                    ->where('approve_status', 1) 
                    ->get();


        if ($members->isEmpty()) {
            return $this->apierror(['error' => 'User not found'], ['id_not_found' => true], 404);
        }
        return $this->apisuccess($members, 'User List');
    }

    public function logout(Request $request)
    {
        
        if (Auth::guard('api')->check()) {
            $user = Auth::guard('api')->user();
            $user->tokens->each(function ($token) {
                $token->delete(); 
            });
            return response()->json(['message' => 'User logged out successfully.'], 200);
        }

        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();
            if ($admin->token()) {
                $admin->token()->revoke();
            }
            return response()->json(['message' => 'Admin logged out successfully.'], 200);
        }

        return response()->json(['message' => 'Unauthenticated'], 401);
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
    public function byvillage(Request $request)
    {
        $v_villages = User::offset($request->start * $request->length)
                    ->limit($request->length)
                    ->select( 
                        'v_village', 
                        'v_district', 
                        'v_taluka', 
                        DB::raw('count(*) as total'), 
                        DB::raw('SUM(v_village IS NOT NULL) as village_user_count'), 
                    )
                    ->groupBy(
                        'v_village',
                        'v_district', 'v_taluka')
                    ->get();

        foreach ($v_villages as $village) {
            $village->users = User::where('v_village', $village->v_village)
                            ->where('v_district', $village->v_district)
                            ->where('v_taluka', $village->v_taluka)
                            ->get();
        }    

        $c_villages = User::offset($request->start * $request->length)
                    ->limit($request->length)
                    ->select( 
                    'c_village', 
                    'c_district', 
                    'c_taluka', 
                    DB::raw('count(*) as total'),
                    DB::raw('SUM(c_village IS NOT NULL) as c_village_user_count')
                )
                ->groupBy(
                    'c_village',
                    'c_district', 'c_taluka')
                ->get();

        foreach ($c_villages as $village) {
            $village->users = User::where('c_village', $village->c_village)
                ->where('c_district', $village->c_district)
                ->where('c_taluka', $village->c_taluka)
                ->get();
        }

        if ($v_villages->isEmpty()) {
            return $this->apierror(['error' => 'Family not found'], ['id_not_found' => true], 404);
        
        } elseif ($c_villages->isEmpty()) {
            return $this->apierror(['error' => 'Family not found'], ['id_not_found' => true], 404);
        
        } else {
            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => "Family by Village",
                'data' => [
                    'v_villages' => $v_villages,
                    'c_villages' => $c_villages,
                ],
            ]);
        }
    }
    
    // public function byphlink(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'filter_param.id' => 'required|exists:users,id',
    //     ]);
    //     if ($validator->fails()) {
    //         return $this->apierror(['errors' => $validator->errors()->all()]);
    //     }

    //     $id = $request->filter_param['id'];

    //     $user = User::find($id);
    //     $phone = $user->ph_no;

    //     $visitedPhones = [];
    //     $relatedPhones = [];

    //     $findRelatedPhones = function ($phone) use (&$visitedPhones, &$relatedPhones, &$findRelatedPhones) {
    //         if (in_array($phone, $visitedPhones)) {
    //             return;  
    //         }

    //         $visitedPhones[] = $phone;

    //         $directMembers = User::where('ph_no', $phone)
    //                         ->orWhere('elder_ph_no', $phone)
    //                         ->get();

    //         foreach ($directMembers as $member) {
    //             if (!in_array($member->ph_no, $relatedPhones) && $member->role_type != '1') {
    //                 $relatedPhones[] = $member->ph_no; 
    //                 $findRelatedPhones($member->ph_no); 
    //             }

    //             if (!in_array($member->elder_ph_no, $relatedPhones) && $member->elder_ph_no != NULL) {
    //                 $relatedPhones[] = $member->elder_ph_no; 
    //                 $findRelatedPhones($member->elder_ph_no); 
    //             }
    //         }
    //     };

    //     $findRelatedPhones($phone);

    //     $members = User::offset($request->start * $request->length)
    //             ->limit($request->length)
    //             ->whereIn('ph_no', $relatedPhones)
    //             ->orWhereIn('elder_ph_no', $relatedPhones)
    //             ->get();

    //     if ($members->isEmpty()) {
    //         return $this->apierror(['error' => 'Family not found'], ['id_not_found' => true], 404);
    //     }

    //     return $this->apisuccess($members, 'Family Tree');
    // }

    public function edit(Request $request)
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
                ->pluck('id')->toArray();

        $userIdToUpdate = $request->input('id');

        if (!in_array($userIdToUpdate, $members)) {
            return $this->apierror(
                ['error' => 'You can only update your family members.'], 
                ['not_family_member' => true], 
                403
            ); 
        }

        $userToUpdate = User::findOrFail($userIdToUpdate);
        
        $userToUpdate->update($request->only([
            'first_name',
            'father_name',
            'last_name',
            'ph_no',
            'marital_status',
            'gender',
            'date_of_birth',
            'blood_group',  
            'c_address',
            'c_district',
            'c_taluka',
            'c_village',
            'v_address',
            'v_district',
            'v_taluka',
            'v_village',
            'education',
            'profession',
            'business_category',
        ]));
        return $this->apisuccess($userToUpdate, 'Data Updated');
    }

    public function delete(Request $request)
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
                ->pluck('id')->toArray();

        $userIdToDelete = $request->input('id');
        
        if (!in_array($userIdToDelete, $members)) {
            return $this->apierror(
                ['error' => 'You can only update your family members.'], 
                ['not_family_member' => true], 
                403
            );    
        }

        $members = User::where('id', $userIdToDelete)->delete();

        return $this->apisuccess($userIdToDelete, 'Deleted');
    }

}
