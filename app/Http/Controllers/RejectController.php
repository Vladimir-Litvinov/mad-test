<?php

namespace App\Http\Controllers;

use App\Http\Requests\RejectRequest;
use App\Models\Reject;
use App\Models\Status;
use Illuminate\Http\Request;

class RejectController extends Controller
{
    public function store(RejectRequest $request)
    {

        $reject = new Reject($request->all());
        if ($reject->appointment->status_id == Status::WAITING) {
            $reject->appointment->update(['status_id' => Status::REJECTED]);
            $reject->save();
            return response()->json([
                'code' => 0,
                'message' => 'Appointment has been rejected',
                'data' => $reject

            ]);
        } else {
            return response()->json([
                'code' => 1,
                'message' => 'Appointment cannot be rejected. Appointment status is not "Waiting for submissions"',
            ]);
        }

    }
}
