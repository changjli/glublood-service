<?php

namespace App\Http\Controllers;

use App\Classes\ResponseTemplate;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\ResendCodeRequest;
use App\Http\Requests\SendCodeRequest;
use App\Http\Requests\VerifyCodeRequest;
use App\Http\Resources\UserResource;
use App\Mail\VerificationMail;
use App\Models\User;
use App\Models\VerificationCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function sendCode(SendCodeRequest $request)
    {
        $details = [
            'email' => $request->email,
        ];
        DB::beginTransaction();
        try {

            $verificationCode = VerificationCode::where('email', $details['email'])->first();

            if ($verificationCode && $verificationCode->verified_at) {
                ResponseTemplate::sendResponseErrorWithRollback();
            }

            if ($verificationCode) {
                $verificationCode->delete();
            }

            $code = $this->generateRandomString(6);

            VerificationCode::create([
                'email' => $details['email'],
                'code' => $code,
                'expires_at' => Carbon::now()->addMinutes(3),
            ]);

            Mail::to($details['email'])->send(new VerificationMail($code));

            return ResponseTemplate::sendResponseSuccessWithCommit(message: 'Email verifikasi telah dikirim!');
        } catch (\Exception $ex) {
            return ResponseTemplate::sendResponseErrorWithRollback($ex);
        }
    }

    public function verifyCode(VerifyCodeRequest $request)
    {
        $details = [
            'email' => $request->email,
            'code' => $request->code,
        ];
        DB::beginTransaction();
        try {
            $verificationCode = VerificationCode::where('email', $details['email'])->where('code', $details['code'])->first();

            if (!$verificationCode || $verificationCode->expires_at < Carbon::now()) {
                return ResponseTemplate::sendResponseErrorWithRollback(message: 'Verifikasi email gagal!');
            }

            // create default password, is_active is false 
            User::create([
                'email' => $details['email'],
                'password' => 'password',
                'email_verified_at' => Carbon::now(),
            ]);

            $verificationCode->delete();

            return ResponseTemplate::sendResponseSuccessWithCommit(message: 'Verifikasi email berhasil!');
        } catch (\Exception $ex) {
            return ResponseTemplate::sendResponseErrorWithRollback($ex);
        }
    }

    public function register(RegisterRequest $request)
    {
        $details = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        DB::beginTransaction();
        try {
            $user = User::where('email', $details['email'])->whereRaw('email_verified_at IS NOT NULL')->first();

            // check if email is verified 
            if (!$user) {
                return ResponseTemplate::sendResponseErrorWithRollback(message: 'Registrasi gagal!');
            }

            $user->update([
                'password' => $details['password'],
                'is_active' => true,
            ]);

            return ResponseTemplate::sendResponseSuccessWithCommit(message: 'Registrasi berhasil!');
        } catch (\Exception $ex) {
            return ResponseTemplate::sendResponseErrorWithRollback($ex);
        }
    }

    public function login(LoginRequest $request)
    {
        $details = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        try {
            $credentials = $details;

            $user = User::where('email', $credentials['email'])->first();

            // check if email is verified but password not change 
            if (!$user->is_active) {
                return ResponseTemplate::sendResponseError(message: 'Login gagal!');
            }

            if (!$token = auth()->attempt($credentials)) {
                return ResponseTemplate::sendResponseError(message: 'Login gagal!');
            }

            return response()->json([
                'status' => 200,
                'message' => 'Login berhasil!',
                'data' => $user,
                'token' => $token,
            ], 200);
        } catch (\Exception $ex) {
            return ResponseTemplate::sendResponseError($ex);
        }
    }

    public function logout()
    {
        try {
            auth()->logout(true);

            return ResponseTemplate::sendResponseSuccess(message: 'Logout berhasil!');
        } catch (\Exception $ex) {
            return ResponseTemplate::sendResponseError($ex);
        }
    }

    private function generateRandomString($length)
    {
        return substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
    }
}
