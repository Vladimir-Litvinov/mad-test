<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{

    public function index()
    {
        return response()->json([
            'code' => 0,
            'message' => 'statuses list',
            'data' => Status::get()
        ]);
    }
}
