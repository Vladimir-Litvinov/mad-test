<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'country' => 'required',
            'city' => 'required',
            'street' => 'required',
            'house' => 'required',
            'package_id' => 'required|exists:packages,id',
            'specific_time' => '|date_format:"Y-m-d H:i"'
        ];
    }
}
