<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reject extends Model
{
    protected $fillable = ['appointment_id','comment'];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
