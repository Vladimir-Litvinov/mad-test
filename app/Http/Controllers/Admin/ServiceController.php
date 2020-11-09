<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageService;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::OrderBy('id','desc')->simplePaginate(20);
        return view('service.index',compact('services'));
    }

    public function update(Service $service, Request $request)
    {
        $service->update($request->all());
        $package_id = PackageService::where('service_id',$service->id)->pluck('package_id');
        $packages = Package::whereIn('id',$package_id)->get();

        foreach ($packages as $package)
        {
            $total_price = $package->services->pluck('price')->sum();
            $package->update(['price' => $total_price]);
        }

        return redirect()->route('service.index');
    }

    public function edit(Service $service)
    {
        return view('service.edit', compact('service'));
    }

    /**
     * update a price package and delete service
     * @param Service $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Service $service)
    {

        $package_id = PackageService::where('service_id',$service->id)->pluck('package_id');
        $packages = Package::whereIn('id',$package_id)->get();
        foreach ($packages as $package)
        {
            $total_price = $package->services->pluck('price')->sum() - $service->price;
            $package->update(['price' => $total_price]);
        }
        $service->delete();
        return redirect()->route('service.index');
    }

    public function create(Service $service)
    {
        return view('service.create', compact('service'));
    }

    public function store(Request $request)
    {
        $service = new Service($request->all());
        $service->save();
        return redirect()->route('service.index');
    }
}
