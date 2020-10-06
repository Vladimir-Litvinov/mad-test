<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['title' , 'price'];

    public function package(){
        return $this->belongsToMany(Package::class,'package_service','service_id');
    }

}
