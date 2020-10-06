<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'country',
        'city',
        'street',
        'house',
        'zip_code',
        'asap',
        'specific_time',
        'comment',
        'package_id',
        'client_id',
        'detailer_id',
        'status_id',
        'status_detailer_id',
        'is_favorite',
        'price'

    ];

    const FAVORITE_YES = 1;
    const FAVORITE_NO = 0;

    const APPLICATION_TIME = 10; //ВРЕМЯ ПРИМЕНЕНИЯ

    const CANCEL_TIME = 10;//ОТМЕНА ВРЕМЕНИ

    public static function boot()
    {
        parent::boot();

        static::creating(function (Appointment $appointment) {
            $appointment->is_favorite = 0;
            $appointment->price = $appointment->package->price;
        });
    }

    public function package(){
        return $this->belongsTo(Package::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function statusDetailer(){
        return $this->belongsTo(Status::class, 'status_detailer_id');
    }

    public function detailer(){
        return $this->belongsTo(User::class, 'detailer_id');
    }

    public function client(){
        return $this->belongsTo(User::class, 'client_id');
    }
}
