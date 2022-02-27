<?php

namespace App\Http\Requests;


class UserRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'phone_number' => 'required|numeric|unique:users,phone_number',
            'country' => 'required|string',
            'city' => 'required|string',
            'address' => 'string',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required!',
            'email.unique' => 'Email should be unique!',
            'password.required' => 'Password is required!'
        ];
    }


}
