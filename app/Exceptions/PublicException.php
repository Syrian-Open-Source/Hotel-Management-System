<?php

namespace App\Exceptions;

use Exception;

class PublicException extends Exception
{
    /**
     * render the response error.
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @author karam mustafa
     */
    public function render()
    {
        $code = 400;
        if (isset($this->code) && $this->code != 0) {
            $code = $this->code;
        }
        $arr = [
            'data' => 'null',
            'message' => $this->resolveMessage($this->message),
            'error' => $this->message != null ? true : false,
            'status' => $code,
        ];
        return response($arr, $arr['status']);
    }

    /**
     * this function is determine if the error message is json string contains array of validations messages
     *
     * @param $message
     * @return array|string
     * @author karam mustafa
     */
    public function resolveMessage($message)
    {
        return gettype(json_decode($message)) == 'array'
            ? json_decode($message)
            : $message;
    }
}
