<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['title', 'price', 'comment', 'category_id', 'user_id'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function packageServices(){
        return $this->hasMany(PackageService::class,'package_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'package_services', 'package_id');
    }

    public function Service($request, $package)
    {
        foreach ($request->all()['service_id'] as $item) {
            PackageService::create([
                'package_id' => $package->id,
                'service_id' => $item
            ]);
            $total_price = $package->services->pluck('price')->sum();
            $package->update([
               'price' => $total_price
            ]);
        }
    }
}
