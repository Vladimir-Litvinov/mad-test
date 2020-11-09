<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Traits\PhotoTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    use PhotoTrait;

    public function index()
    {
        $users = User::orderBy('id', 'desc')
            ->where('role', '=', User::ROLE_CLIENT)
            ->simplePaginate(10);
        return view('user.index', compact('users'));
    }

    public function detailers()
    {
        $detailers = User::orderBy('id', 'desc')
            ->where('role', '=', User::ROLE_DETAILER)
            ->simplePaginate(10);
        return view('detailer.index', compact('detailers'));
    }

    public function edit(User $user)
    {
        return view('detailer.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        if ($request->has('image')) {
            $path = config('constants.image_folder.user_photo.save_path');
            if (!is_null($user->image)) {
                $this->deletePhoto($user->getOriginal('image'), $path);
                $user->update($request->except('image'));
            }
        }
        $user->update($request->except('image'));
        return redirect()->route('detailers');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('detailers');
    }

    public function create(User $user)
    {
        return view('detailer.create', compact('user'));
    }

    public function store(UserRequest $request)
    {
        $user = new User($request->all());
        $password = rand(000000, 999999);
        $user->password = Hash::make($password);
        $user->role = User::ROLE_DETAILER;

        if (!empty($request->image)) {
            $path = config('constants.image_folder.user_photo.save_path');
            $user->image = $this->savePhoto($request->image, $path);
        }
        $user->save();
        Mail::send('detailer.account', compact('password'), function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Account');
        });

        return redirect()->route('detailers');

    }
}
