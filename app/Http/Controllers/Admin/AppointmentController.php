<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{

    public function index()
    {
        $appointments = Appointment::orderBy('id', 'desc')->simplePaginate(10);
        return view('appointment.index', compact('appointments'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Appointment $appointment)
    {
        return view('appointment.show',compact('appointment'));
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function userAppointments(User $user)
    {
        $appointments = Appointment::orderBy('id','desc')
            ->where('client_id',$user->id)
            ->orWhere('detailer_id',$user->id)
            ->simplePaginate(10);
        return view('appointment.index',compact('appointments'));
    }
}
