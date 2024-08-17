<?php

namespace App\Http\Controllers;

use App\Classes\ResponseTemplate;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\ResendCodeRequest;
use App\Http\Requests\SendCodeRequest;
use App\Http\Requests\VerifyCodeRequest;
use App\Http\Resources\LoginResource;
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
            $code = $this->generateRandomString(6);

            VerificationCode::updateOrCreate(
                [
                    'email' => $details['email'],
                ],
                [
                    'email' => $details['email'],
                    'code' => $code,
                    'expires_at' => Carbon::now()->addMinutes(3),
                ]
            );

            Mail::to($details['email'])->send(new VerificationMail($code));

            return ResponseTemplate::sendResponseSuccessWithCommit(message: 'Email verifikasi telah dikirim!');
        } catch (\Exception $ex) {
            return ResponseTemplate::sendResponseErrorWithRollback($ex);
        }
    }

    public function register(RegisterRequest $request)
    {
        $details = [
            'email' => $request->email,
            'password' => $request->password,
            'code' => $request->code,
        ];
        DB::beginTransaction();
        try {
            $verificationCode = VerificationCode::where('email', $details['email'])->where('code', $details['code'])->first();

            if (!$verificationCode || $verificationCode->expires_at < Carbon::now()) {
                return ResponseTemplate::sendResponseErrorWithRollback(message: 'Registrasi gagal!');
            }

            User::create([
                'email' => $details['email'],
                'password' => $details['password'],
                'email_verified_at' => Carbon::now(),
            ]);

            $verificationCode->delete();

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

            if (!$token = auth()->attempt($credentials)) {
                return ResponseTemplate::sendResponseError(message: 'Login gagal!');
            }

            $user = User::where('email', $credentials['email'])->first();

            // check if email is not verified
            if (!$user->email_verified_at) {
                return ResponseTemplate::sendResponseError(message: 'Login gagal!');
            }

            return response()->json([
                'status' => 200,
                'message' => 'Login berhasil!',
                'data' => new LoginResource($user),
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
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

    public function refresh()
    {
        try {
            $token = auth()->refresh(true);

            return response()->json([
                'status' => 200,
                'message' => 'Refresh token berhasil!',
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ], 200);
        } catch (\Exception $ex) {
            return ResponseTemplate::sendResponseError($ex);
        }
    }

    private function generateRandomString($length)
    {
        return substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
    }
}
