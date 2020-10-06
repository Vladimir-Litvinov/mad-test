<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
use App\Models\Status;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(AppointmentRequest $request)
    {
        $appointment = new Appointment($request->all());
        $appointment->client_id = auth()->user()->id();
        $appointment->status_id = Status::WAITING;
        $appointment->save();
        return response()->json([
           'code' => 0,
           'message' => 'Appointment has been created',
           'data' => $appointment->load('package.services','detailer', 'status'),
        ]);
    }


    public function show(Appointment $appointment)
    {
        //
    }


    public function edit(Appointment $appointment)
    {
        //
    }


    public function update(Request $request, Appointment $appointment)
    {
        //
    }


    public function destroy(Appointment $appointment)
    {
        //
    }
}
