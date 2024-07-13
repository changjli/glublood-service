<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use App\Http\Requests\StoreUserProfileRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use Illuminate\Support\Facades\DB;
use App\Classes\ResponseTemplate;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserProfileRequest $request)
    {
        $details = [
            'fullname' => $request->fullname,
            'weight' => $request->weight,
            'height' => $request->height,
            'age' => $request->age,
            'DOB' => $request->DOB,
            'gender' => $request->gender,
            'is_descendant_diabetes' => $request->is_descendant_diabetes,
            'is_diabetes' => $request->is_diabetes,
            'medical_history' => $request->medical_history,
            'diabetes_type' => $request->diabetes_type,
        ];
        
        DB::beginTransaction();
        
        try {
            $userProfile = UserProfile::create([
                'fullname' => $details['fullname'],
                'weight' => $details['weight'],
                'height' => $details['height'],
                'age' => $details['age'],
                'DOB' => $details['DOB'],
                'gender' => $details['gender'],
                'is_descendant_diabetes' => $details['is_descendant_diabetes'],
                'is_diabetes' => $details['is_diabetes'],
                'medical_history' => $details['medical_history'],
                'diabetes_type' => $details['diabetes_type'],
            ]);

            return ResponseTemplate::sendResponseSuccessWithCommit(message: 'Pengisian User Profile Berhasil');
        } catch (\Exception $ex) {
            return ResponseTemplate::sendResponseErrorWithRollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UserProfile $userProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserProfile $userProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserProfileRequest $request, UserProfile $userProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProfile $userProfile)
    {
        //
    }
}
