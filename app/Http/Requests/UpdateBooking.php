<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateBooking extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'room_id'        => 'integer|exists:rooms,id',
            'start_date'     => 'date|date_format:Y-m-d|after_or_equal:today',
            'end_date'       => 'date|date_format:Y-m-d|after_or_equal:start_date',
            'status'         => 'in:true,false'
        ];
    }

    public function messages()
    {
        return [
            'room_id.exists' => 'Room id is not exist!',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
        'errors' => $validator->errors(),
        ], 422));
    }

}
