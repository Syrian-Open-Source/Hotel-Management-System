<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRoom extends FormRequest
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
            'room_type'  => 'integer|exists:room_types,id',
            'rate'       => 'integer|between:0,5',
            'extra'      => 'string',
            'status'     => 'boolean',
            'price'      => 'integer|min:1'
        ];
    }

    public function messages()
    {
        return [
            'room_type.exists' => 'Your room type is not exist!',
            'rate.integer' => 'Your Rate should be between 0 and 5 !',
            'price.min' => 'You cant but a price less than 1$ !',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
        'errors' => $validator->errors(),
        ], 422));
    }

}
