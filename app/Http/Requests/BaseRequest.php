<?php


namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
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
     * this function resolve validation error message
     *
     *
     * @param  Validator  $validator
     *
     * @return void
     * @author karam mustaf
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }

    /**
     * this function to check if request is update request
     *
     * @return bool
     * @author karam mustaf
     */
    public function isUpdatedRequest()
    {
        return request()->isMethod("PUT") || request()->isMethod("PATCH");
    }

    /**
     * this function to return all required rule for an image
     *
     * @return string
     * @author karam mustaf
     */
    public function imageRule()
    {
        return "{$this->required()}|mimes:jpeg,png,jpg,gif,svg|max:2048";
    }

    /**
     * this function to return all required rule for date request parameter
     *
     * @return string
     * @author karam mustaf
     */
    public function dateRules()
    {

        return "{$this->required()}|after:now";
    }

    /**
     * check if the request is update request then don't verify if the request key is required.
     *
     * @return string
     * @author karam mustaf
     */
    public function required()
    {
        return $this->isUpdatedRequest() ? 'sometimes' : 'required';
    }

}
