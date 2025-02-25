<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfileImageRequest;
use App\Http\Resources\GetUserProfileDetailResource;
use App\Models\UserProfile;
use App\Http\Requests\StoreUserProfileRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use Illuminate\Support\Facades\DB;
use App\Classes\ResponseTemplate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

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
        $user = auth()->user();

        $details = [
            'user_id' => $user->id,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
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
            $userProfile = UserProfile::where('user_id', $user->id)->first();

            if ($userProfile) {
                return ResponseTemplate::sendResponseErrorWithRollback(message: 'User profile for ' . $user->email . ' already exists.');
            }

            $userProfile = UserProfile::create([
                'user_id' => $details['user_id'],
                'firstname' => $details['firstname'],
                'lastname' => $details['lastname'],
                'weight' => $details['weight'],
                'height' => $details['height'],
                'age' => $details['age'],
                'DOB' => $details['DOB'],
                'gender' => $details['gender'],
                'is_descendant_diabetes' => $details['is_descendant_diabetes'],
                'is_diabetes' => $details['is_diabetes'],
                'medical_history' => $details['medical_history'],
                'diabetes_type' => $details['diabetes_type'],
                'image' => '-',
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
        $user = auth()->user();

        try {
            $userProfile = UserProfile::where('user_id', $user->id)->first();

            if (!$userProfile) {
                return ResponseTemplate::sendResponseError(message: 'User profile not found.');
            }

            return ResponseTemplate::sendResponseSuccess(message: 'Show User Profile Berhasil!', result: new GetUserProfileDetailResource($userProfile), code: 200);
        } catch (\Exception $ex) {
            return ResponseTemplate::sendResponseError($ex);
        }
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
    public function update(UpdateUserProfileRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = auth()->user();

            $userProfile = UserProfile::where('user_id', $user->id)->first();

            if (!$userProfile) {
                return ResponseTemplate::sendResponseError(message: 'User profile not found.');
            }

            $userProfile->update([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'weight' => $request->weight,
                'height' => $request->height,
                'age' => $request->age,
                'DOB' => $request->DOB,
                'gender' => $request->gender,
                'is_descendant_diabetes' => $request->is_descendant_diabetes,
                'medical_history' => $request->medical_history,
                'is_diabetes' => $request->is_diabetes,
                'diabetes_type' => $request->diabetes_type,
            ]);

            DB::commit();

            return ResponseTemplate::sendResponseSuccess(message: 'Update User Profile Berhasil!');
        } catch (\Exception $ex) {
            Log::info($ex);
            DB::rollBack();
            return ResponseTemplate::sendResponseErrorWithRollback(message: 'Failed to update user profile'); // Internal Server Error status code
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProfile $userProfile)
    {
        //
    }

    public function saveProfileImage(Request $request)
    {
        $user = auth()->user();

        $userProfile = UserProfile::where('user_id', $user->id)->first();
        $oldProfileImage = $userProfile->profile_image;

        if (!$userProfile) {
            return ResponseTemplate::sendResponseError(message: 'User profile not found.');
        }

        $profileImage = $request->file('profile_image');

        if ($profileImage) {
            $data['profile_image'] = Storage::url(Storage::disk('local')->put('public', $profileImage));

            $userProfile->update($data);

            Storage::disk('local')->delete(str_replace('/storage', 'public', $oldProfileImage));
        }
    }

    public function deleteProfileImage()
    {
        $user = auth()->user();

        $userProfile = UserProfile::where('user_id', $user->id)->first();
        $oldProfileImage = $userProfile->profile_image;

        if (!$userProfile) {
            return ResponseTemplate::sendResponseError(message: 'User profile not found.');
        }

        $data['profile_image'] = null;

        $userProfile->update($data);

        Storage::disk('local')->delete(str_replace('/storage', 'public', $oldProfileImage));
    }
}
