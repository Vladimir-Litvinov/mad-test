<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentFavoriteRequest;
use App\Http\Requests\AppointmentRequest;
use App\Http\Requests\AppointmentTimeRequest;
use App\Models\Appointment;
use App\Models\Status;
use Carbon\Carbon;
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
        $appointment->client_id = auth()->user()->id;
        $appointment->status_id = Status::WAITING;
        $appointment->save();
        return response()->json([
            'code' => 0,
            'message' => 'Appointment has been created',
            'data' => $appointment->load('package.services', 'detailer', 'status'),
        ]);
    }


    public function show(Appointment $appointment)
    {
        return response()->json([
            'code' => 0,
            'message' => 'Appointment',
            'data' => $appointment->load('package.services', 'detailer', 'status'),
        ]);
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

    public function changeTime(Appointment $appointment, AppointmentTimeRequest $request)
    {
        if ($appointment->status_id == Status::WAITING
            || $appointment->status_id == Status::REJECTED
            || $appointment->status_id == Status::SAVED_TO_LATER) {
            $appointment->update([
                'specific_time' => null,
                'asap' => null,
            ]);
            if (!is_null($request->asap)) {
                $appointment->created_at = Carbon::now();
                $appointment->update($request->only('created_at', 'asap'));
            }
            if (is_null($request->specific_time)) {
                $appointment->update($request->only('specific_time'));
            }

            $appointment->update(['status_id' => Status::WAITING]);
            return response()->json([
                'code' => 0,
                'message' => 'time has been changed',
                'data' => $appointment->load('package.service', 'status', 'detailer')
            ]);
        } else {
            return response()->json([
                'code' => 1,
                'message' => 'The time cannot be changed. Appointment status is not "Waiting for submissions',
                //Время изменить нельзя. Статус встречи не "Ожидание заявок"
            ]);
        }
    }

    public function favorite(Appointment $appointment, AppointmentFavoriteRequest $request)
    {
        $appointment->update($request->only('is_favorite'));
        switch ($request->is_favorite) {
            case 0:
                return response()->json([
                    'code' => 0,
                    'message' => 'The appointment has been removed from favorites'
                ]);
                break;
            case 1:
                return response()->json([
                    'code' => 0,
                    'message' => 'The appointment has been added from favorites'
                ]);
                break;
        }
    }

    public function favorites()
    {
        $appointment = Appointment::where('is_favorite', Appointment::FAVORITE_YES)
            ->where('client_id', auth()->user()->id)
            ->with('package.services','status','detailer')
            ->paginate(5);
        return response()->json([
            'code' => 0,
            'massage' => 'Favorite list',
            'data' => $appointment
        ]);
    }
}