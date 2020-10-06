<?php

namespace App\Http\Controllers;

use App\Http\Requests\PackageRequest;
use App\Models\Category;
use App\Models\Package;
use App\Models\Service;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $package = Package::whereNull('user_id')->with('category', 'services')->get();
        return response()->json([
            'code' => 0,
            'message' => 'package list',
            'data' => $package
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(PackageRequest $request)
    {
        $user = auth()->user();
        $package = new Package($request->all());
        $package->user_id = $user->id;
        $package->save();
        $package->Service($request, $package);
        return response()->json([
            'code' => 0,
            'message' => 'package has been created',
            'data' => $package->load('category','services')
        ]);

    }

    public function myPackages(){
        $packages = Package::orderby('id','desc')
            ->where('user_id', auth()->user()->id)
            ->with('category','services')
            ->get();
        return response()->json([
            'code' => 0,
            'message' => 'custom packages',
            'data' => $packages
        ]);
    }

    public function show(Package $package)
    {
        return response()->json([
           'code' => 0,
           'massage' => 'package list',
           'data' => $package->load('category','services')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Package $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        //
    }


    public function update(PackageRequest $request, Package $package)
    {
        $package->update($request->all());
        $package->packageServices()->delete();
        $package->Service($request,$package);
        return response()->json([
           'code' => 0,
           'message' => 'package has been updated',
           'data' => $package->load('category', 'services')
        ]);
    }


    public function destroy(Package $package)
    {
        return response()->json([
           'code' => 0,
           'message' => 'package has been deleted',
           'deleted' => $package->delete()
        ]);
    }

    public function getByCategory(Category $category){
        $user = auth()->user();
        $package = Package::where('category_id',$category->id)
            ->whereNull('user_id')
            ->OrWhere('user_id',$user->id)
            ->with('category','services')
            ->get();
        return response()->json([
            'code' => 0,
            'message' => 'packages list by category',
            'data' => $package
        ]);
    }

    public function services(){
        $service = Service::get();
        return response()->json([
            'code' => 0,
            'message' => 'services',
            'data' => $service
        ]);
    }
}
