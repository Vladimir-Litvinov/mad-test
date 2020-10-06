<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use JWTAuth;
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

//    public function register(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255|unique:users',
//            'password' => 'required|string|min:6|confirmed',
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json($validator->errors()->toJson(), 400);
//        }
//
//        $user = User::create([
//            'name' => $request->get('name'),
//            'email' => $request->get('email'),
//            'phone' => $request->get('phone'),
//            'role' => User::ROLE_CLIENT,
//            'password' => Hash::make($request->get('password')),
//        ]);
//
//        $token = JWTAuth::fromUser($user);
//        return response()->json(['code' => 0, 'data' => $user, 'token' => $token]);
//    }

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
}
