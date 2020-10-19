<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentFavoriteRequest;
use App\Http\Requests\AppointmentRequest;
use App\Http\Requests\AppointmentTimeRequest;
use App\Http\Requests\AppointmentUpdateRequest;
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
            'data' => $appointment
        ]);
    }


    public function edit(Appointment $appointment)
    {
        //
    }


    public function update(Appointment $appointment, AppointmentUpdateRequest $request)
    {
        $appointment->update($request->except('package_id'));
        return response()->json([
            'code' => 0,
            'message' => 'Appointment has been updated',
            'data' => $appointment->load('package.services', 'status')
        ]);
    }


    public function destroy(Appointment $appointment)
    {
        //
    }

    public function waiting(Appointment $appointment, Request $request)
    {
        if ($appointment->status_id == Status::WAITING) {
            if (!is_null($appointment->specific_time)) {
                $appointment->update([
                    'specific_time' => Carbon::make($appointment->specific_time)->addMinutes(Appointment::APPLICATION_TIME)
                ]);
            }
            if (!is_null($appointment->asap)) {
                $appointment->created_at = Carbon::now();
                $appointment->update($request->only('created_at'));
            }
            return response()->json([
                'code' => 0,
                'message' => 'continue waiting',
                'data' => $appointment
            ]);
        } else {
            return response()->json([
                'code' => 1,
                'message' => 'Appointment status is not "Waiting for submissions"'
            ]);
        }


    }

    public function addresses()
    {
        $app = Appointment::where('client_id', auth()->user()->id)->get(['country', 'city', 'street', 'house', 'zip_code']);
        $unique = $app->unique(function ($item) {
            return $item['country'] . $item['city'] . $item['street'] . $item['house'] . $item['zip_code'];
        });
        return response()->json([
            'code' => 0,
            'data' => $unique->values()
        ]);
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

    public function historyClient()
    {
        $appointment = Appointment::where('client_id', auth()->user()->id)
            ->where('status_id', Status::DONE)
            ->with('package.services', 'detailer')
            ->paginate(5);
        return response()->json([
            'code' => 0,
            'message' => 'History',
            'data' => $appointment
        ]);
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
            ->with('package.services', 'status', 'detailer')
            ->paginate(5);
        return response()->json([
            'code' => 0,
            'massage' => 'Favorite list',
            'data' => $appointment
        ]);
    }
}
