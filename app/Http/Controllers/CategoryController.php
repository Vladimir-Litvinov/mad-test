<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
       return response()->json([
            'code' => 0,
            'message' => 'categories list',
            'data' => Category::get()
        ]);
    }




}
