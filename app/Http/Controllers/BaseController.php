<?php


namespace App\Http\Controllers;


use App\Helpers\Classes\Response;
use Illuminate\Database\Eloquent\Model;

class BaseController extends Controller
{
    use Response;

    /**
     * throw an exception or  return to the not found page if the data dose not match any model resource.
     *
     * @param $key
     * @param $value
     * @param $model
     *
     * @return mixed
     * @throws \Exception
     * @author karam mustafa
     */
    public function checkIfExists(Model $model, $key = 'id', $value = '')
    {
        $result = $model::where($key, $value)->first();
        if (isset($result)) {
            return $result;
        }

        throw new \Exception(trans('not_found'), $this->NOT_FOUND);
    }
}
