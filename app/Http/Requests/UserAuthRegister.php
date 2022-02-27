<?php

namespace App\Http\Requests;


class UserAuthRegister extends BaseRequest
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
            'VIP' => 'boolean'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required!',
            'email.email' => 'Your Email is not email form!',
            'email.unique' => 'Your Email is used from another user!',
            'password.required' => 'Password is required!',
            'phone_number.required' => 'Password is required!',
            'country.required' => 'Password is required!',
            'city.required' => 'Password is required!',
        ];
    }
}
