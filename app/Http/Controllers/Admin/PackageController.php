<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageService;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::orderBy('id', 'desc')->simplePaginate(10);
        return view('package.index', compact('packages'));
    }

    public function update(Package $package, Request $request)
    {
        $package->packageServices()->delete();
        foreach ($request->all()['service_id'] as $item) {
            PackageService::updateOrCreate([
                'package_id' => $package->id,
                'service_id' => $item
            ]);
        }
        $package->update($request->all());
        $total_price = $package->services->pluck('price')->sum();
        $package->update(['price' => $total_price]);
        return redirect()->route('package.index');
    }

    public function edit(Package $package)
    {
        return view('package.edit', compact('package'));
    }


    public function destroy(Package $package)
    {

        $package->delete();
        return redirect()->route('package.index');
    }

    public function create(Package $package)
    {
        return view('package.create', compact('package'));
    }

    public function store(Request $request)
    {
        $package = new Package($request->all());
        $package->save();
        foreach ($request->all()['service_id'] as $item) {
            PackageService::create([
                'package_id' => $package->id,
                'service_id' => $item
            ]);
        }
        $total_price = $package->services->pluck('price')->sum();
        $package->update(['price' => $total_price]);
        return redirect()->route('package.index');
    }
}
