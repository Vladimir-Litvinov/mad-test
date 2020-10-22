<?php

namespace App\Http\Controllers;

use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index()
    {
        $support = Support::first();
        return response()->json([
            'code' => 0,
            'date' => $support
        ]);
    }
}
