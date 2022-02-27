<?php

namespace App\Http\Requests;


class UpdateRoomRequest extends BaseRequest
{

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

}
