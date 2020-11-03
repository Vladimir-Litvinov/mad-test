<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Status;
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
        return view('appointment.show', compact('appointment'));
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

    public function editStatus(Appointment $appointment)
    {
        return view('appointment.editStatus', compact('appointment'));
    }

    public function changeStatus(Appointment $appointment, Request $request)
    {
        if ($request->status_id == Status::NOT_PAID) {
            $appointment->update($request->only('status_id'));
        } else {
            $appointment->update($request->only('status_id'));
        }
        return redirect()->route('appointment.index');
    }
    public function getDetailer(Appointment $appointment)
    {
        $detailer_id = Appointment::where('id', $appointment->id)->pluck('detailer_id');
        $detailers = User::where('id', $detailer_id)->simplePaginate(5);
        return view('detailer.index', compact('detailers'));
    }

    public function userAppointments(User $user)
    {
        $appointments = Appointment::orderBy('id', 'desc')
            ->where('client_id', $user->id)
            ->orWhere('detailer_id', $user->id)
            ->simplePaginate(10);
        return view('appointment.index', compact('appointments'));
    }
}
