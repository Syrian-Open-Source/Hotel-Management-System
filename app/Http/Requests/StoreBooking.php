<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreBooking extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'room_id'  => 'required|integer|exists:rooms,id',
            'start_date'     => 'required|date|date_format:Y-m-d|after_or_equal:today',
            'end_date'      => 'required|date|date_format:Y-m-d|after_or_equal:start_date'
        ];
    }

    public function messages()
    {
        return [
            'room_id.required' => 'Room id is required!',
            'room_id.exists' => 'Room id is not exist!',
            'start_date.required' => 'Start Date is required!',
            'end_date.required' => 'End Date is required!',
        ];
    }

}
