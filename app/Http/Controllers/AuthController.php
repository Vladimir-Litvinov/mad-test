<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use JWTAuth;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'Wrong data'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['message' => 'Failed to create token'], 500);
        }

        $currentUser = User::where('email', $credentials['email'])->first();

        return response()->json(['code' => 0, 'data' => $currentUser, 'token' => $token]);
    }

    public function redirectToProvider($social)
    {
        return Socialite::driver($social)->stateless()->redirect()->getTargetUrl();
    }

    public function getAuthenticatedUser()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }

    public function forgotPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['code' => 1, 'massage' => 'User not found']);
        }

        $pass = rand(00000, 99999);
        $user->password = Hash::make($pass);
        $user->update($request->only('password'));
        Mail::send('user.reset-password', compact('pass'),
            function ($massage) use ($request) {
                $massage->to($request->email)
                    ->subject('New Password');
            });
        return response()->json(['code' => 0, 'message' => 'Mail sent']);
    }


    public function updatePassword(PasswordRequest $request)
    {
        $user = auth()->user();
        if (Hash::check($request->old_password, $user->password)) {
            $user->update(['password' => Hash::make($request->password)]);
            return response()->json(['code' => 0, 'message' => 'Password updated successfully']);
        }
        return response()->json(['code' => 1, 'message' => 'Invalid old password'], 400);

    }

    public function handleProviderCallback($social,Request $request)
    {
        $user = Socialite::driver($social)->userFromToken($request->access_token);

        try {
            if ($client = User::where('email', $user->email)->first()) {
                $token = JWTAuth::fromUser($client);
            } else {
                $client = new User();
                $client->role = User::ROLE_CLIENT;
                $client->name = $user->name;
                $client->social_id = $user->id;
                $client->email = $user->email;
                $client->image = $user->avatar;
                $client->social = $social;
                $client->save();
                $token = JWTAuth::fromUser($client);
            }
        } catch (JWTException $e) {
            return response()->json([
                'message' => 'Failed to create token'
            ],
                500);
        }
        return response()->json([
            'code' => 0,
            'data' => User::find($client->id),
            'token' => $token
        ]);
    }

}
