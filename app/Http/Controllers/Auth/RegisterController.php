<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use JWTAuth;

class RegisterController extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'email' => $request->get('email'),
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'role' => User::ROLE_CLIENT,
            'password' => Hash::make($request->get('password'))
        ]);
        $token = JWTAuth::fromUser($user);
        return response()->json(['code' => 0, 'date' => $user, 'token' => $token]);
    }
}
