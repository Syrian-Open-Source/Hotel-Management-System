<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRate extends BaseRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'room_id' => 'required|integer|exists:rooms,id',
            'rate'  => 'required|integer|in:1,2,3,4,5'
        ];
    }

    public function messages()
    {
        return [
            'room_id.required' => 'Room ID is required!',
            'rate.required' => 'Rate is required!',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
        'errors' => $validator->errors(),
        ], 422));
    }

}
