<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Http\Traits\PhotoTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    use PhotoTrait;

    public function profile()
    {
        $user = auth()->user();
        return response()->json([
            'code' => 0,
            'message' => 'statuses list',
            'data' => $user
        ]);
    }

    public function update(UserUpdateRequest $request)
    {
        $user = auth()->user();
        if ($request->has('image')) {
            $path = config('constants.image_folder.user_photo.save_path');

            $isbase64 = Str::startsWith($request->image, "data");
            if ($isbase64) {
                if (!is_null($user->image)) {

                    $this->deletePhoto($user->getRawOriginal('image'), $path);
                }
                $user->image = $this->savePhoto($request['image'], $path);
            }
            if (!$isbase64) {
                $user->update($request->except('image'));
            }
            $user->update($request->except('image'));
        }
        $user->update($request->except('image'));
        return response()->json([
            'code' => 0,
            'message' => 'Profile has been updated',
            'data' => $user
        ]);
    }

    public function destroy()
    {
        $user = auth()->user();
        $path = config('constants.image_folder.user_photo.save_path');

        $this->deletePhoto($user->getRawOriginal('image'), $path);
        return response()->json([
            'code' => 0,
            'message' => 'Profile has been deleted',
            'data' => $user->delete()
        ]);
    }
}
