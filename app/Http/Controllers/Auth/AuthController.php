<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Notifications\Register;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

    /**
     * author: ahmad montazeri
     * 29 sep 2021 13:57
     */
class AuthController extends Controller
{
    use Notifiable;
    
    public function login(Request $request)
    {
        //dd("ok");
        if($user = Auth::attempt([
            'username' => $request->input('username'),
            'password' => $request->input('password')]))
        {
            $user = $request->user();
            $tokenResult = $user->createToken('Api Token');
            $token = $tokenResult->token;
            $token->save();

            return response()->json([
                'state' => true,
                'message' => 'you are logged in.',
                'data' => [
                    'token' => $tokenResult->accessToken,
                    'token_type' => 'Bearer',
                    'username' => $user->username,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                ],
            ], 200);
        }

        return response()->json([
            'state' => true,
            'message' => 'user is not found',
            'data' => null
        ], 404);
    }

    public function register(Request $request)
    {
        //dd("ok");
        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->mobile = $request->input('mobile');
        $user->home_phone = $request->input('home_phone');
        $user->work_phone = $request->input('work_phone');
        $user->home_address = $request->input('home_address');
        $user->work_address = $request->input('work_address');
        $user->image = $request->input('image');
        $user->information = json_encode([
            'email_verification_sent_at' => Carbon::now()->toDateTimeString(),
        ], JSON_UNESCAPED_UNICODE);
        if($user->save())
        {
            //dd($user);
            $user->notify(new Register());

            return response()->json([
                'state' => true,
                'message' => "thanks, you are registered successfully. please confirm your email...",
                'data' => null,
            ], 200);

        }

        return response()->json([
            'state' => false,
            'message' => "please try again later.",
            'data' => null,
        ], 500);

    }

    public function verifyEmail(Request $request, User $user, $timestamp)
    {
        $verifyEmail = json_decode($user->information, true);
        if(/*!array_key_exists('email_verified', $verifyEmail) and */!$user->hasVerifiedEmail())
        {
            $signature = $user->id . $user->username . $timestamp;
            //$user->hasVerifiedEmail();
            //dd($signature);

            if($verifyEmail['email_verification_sent_at'] >= Carbon::now()->subMinutes(15))
            {
                if (Hash::check($signature, $request->input('signature')))
                {
                    $user->email_verified_at = Carbon::now();
                    $user->information = json_encode([
                        'email_verified' => Carbon::now()->toDateTimeString(),
                    ], JSON_UNESCAPED_UNICODE);
                    $result = $user->createToken('Api Token');
                    $token = $result->token;
                    if($token->save() and $user->save())
                        return response()->json([
                            'state' => true,
                            'message' => "thanks, your account is verification...",
                            'data' => null,
                        ], 200);
                }
            }
            $user->notify(new Register());

            return response()->json([
                'state' => true,
                'message' => "thanks, verification email send you. please confirm your email...",
                'data' => null,
            ], 200);
        }
        return response()->json([
            'state' => true,
            'message' => "thanks, your email is verified",
            'data' => null,
        ], 200);
    }
}
