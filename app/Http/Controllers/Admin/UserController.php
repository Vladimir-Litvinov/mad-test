<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::orderBy('id','desc')
            ->where('role', '=', User::ROLE_CLIENT)
            ->simplePaginate(10);
        return view('user.index', compact('users'));
    }

}
