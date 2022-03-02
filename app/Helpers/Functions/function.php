<?php

use App\Exceptions\PublicException;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/**
 * determine local lang to chose file;
 *
 * @param  string  $key
 *
 * @return string
 * @author karam mustafa
 */
function myTrans($key)
{
    $local = app()->getLocale();
    return __("{$local}.{$key}");
}

/**
 * determine local lang to chose file;
 *
 * @return string
 * @author karam mustafa
 */
function isRTL()
{
    $local = app()->getLocale();
    return $local == 'ar' ? 'rtl' : 'ltr';
}

/**
 *
 * @param  string  $date
 *
 * @return string
 * @author karam mustafa
 */
function dateFormat($date)
{
    return \Carbon\Carbon::parse($date)->toFormattedDateString();
}

/**
 *
 * @return string
 * @author karam mustafa
 */
function requestToPanel()
{
    return request()->route()->getPrefix() != '/panel';
}

if (!function_exists('currentRouteName')) {
    /**
     * this function get the current route name
     **
     * @return string
     * @author karam mustafa
     */
    function currentRouteName()
    {
        return \Illuminate\Support\Facades\Request::route()->getName();
    }
}
if (!function_exists('isLocalhost')) {
    /**
     * this function check if the app running in localhost
     **
     * @return string
     * @author karam mustafa
     */
    function isLocalhost()
    {
        return parse_url(\Illuminate\Support\Facades\URL::full())['host'] == 'localhost';
    }
}
if (!function_exists('notFoundView')) {
    /**
     * to return slug to string
     **
     *
     * @return string
     * @throws \Exception
     * @author karam mustafa
     */
    function notFoundView()
    {
        return view('404');
    }
}
if (!function_exists('unSlug')) {
    /**
     * to return slug to string
     **
     *
     * @param  string  $title
     * @param  string  $replace
     * @param  string  $replaceTo
     *
     * @return string
     * @author karam mustafa
     */
    function unSlug($title, $replace = '-', $replaceTo = ' ')
    {
        return str_replace($replace, $replaceTo, $title);
    }
}
if (!function_exists('strSlug')) {
    /**
     **
     * @param  string  $title
     * @param  string  $replace
     * @param  string  $replaceTo
     *
     * @return string
     * @author karam mustafa
     */
    function strSlug($title, $replace = ' ', $replaceTo = '-')
    {
        return str_replace($replace, $replaceTo, $title);
    }
}
if (!function_exists('isCurrentRouteName')) {
    /**
     * this function is verify if current user match custom parameter
     *
     * @param  string  $name
     *
     * @param  string  $returnProp
     *
     * @return string
     * @author karam mustafa
     */
    function isCurrentRouteName($name, $returnProp = 'active')
    {
        return currentRouteName() == $name ? $returnProp : '';
    }
}

if (!function_exists('storageAsset')) {
    /**
     * Generate an asset path for the storage application.
     *
     * @param  string  $path
     *
     * @return string
     * @author karam mustafa
     */
    function storageAsset($path)
    {
        return storage_path($path);
    }
}

if (!function_exists('getFileName')) {
    /**
     * Generate an asset path for the storage application.
     *
     * @param  string  $path
     *
     * @return string
     * @author karam mustafa
     */
    function getFileName($path)
    {
        $arr = explode('/', $path);
        return $arr[array_key_last($arr)];
    }
}

if (!function_exists('saveFile')) {
    /**
     * @param $file
     * @param $name
     * @param $path
     * @param  array  $unlink
     *
     * @param  null  $type
     * @param  bool  $check
     *
     * @return mixed|string
     * @throws \App\Exceptions\PublicException
     * @author karam mustafa
     */
    function saveFile($file, $name, $path, $unlink = [], $type = null, $check = true)
    {
        try {
            // check if there any cause require to remove any file before
            if (sizeof($unlink) > 0) {
                $oldPath = substr($unlink['model']['field'], 1);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            // check if request has this file
            if ($check) {
                checkIfFileExists($file, $name);
            }
            // fix file path
            $pathFixing = str_replace('\\', '/', $path);
            // get file name
            $fileName = time().Str::random(15).'.'.$file->getClientOriginalExtension();
            // get final path to save
            $pathFixing = storage_path($pathFixing);
            // move this file
            $path = $file->store("images/public");
            session()->flash('success', __('messages.update_new_success'));
            return $path;
        } catch (\Exception $e) {
            throw new PublicException(
                formatErrorMessage(__CLASS__, __LINE__, $e->getMessage())
            );
        }
    }
}
if (!function_exists('checkIfFileExists')) {
    /**
     * this function to check if request has file
     *
     * @param $file
     * @param $name
     *
     * @return mixed|string
     * @throws PublicException
     * @author karam mustafa
     */
    function checkIfFileExists($file, $name)
    {
        if (isset(request()->all()[$name])) {
            if (gettype(request()->all()[$name]) !== 'array') {
                if (!isset($file) || is_null($file) || !request()->hasFile($name)) {
                    throw new PublicException('please make sure you store correct file');
                }
            }
        }
    }
}

if (!function_exists('fetchCrudGeneratorRoutes')) {
    /**
     *
     *
     * @return mixed|string
     * @throws PublicException
     * @author karam mustafa
     */
    function fetchCrudGeneratorRoutes()
    {
        $routes = getRouteJsonFile();
        $routes = json_decode($routes, true);

        foreach ($routes as $url => $controller) {
            Route::resource($url, $controller);
        }
    }
}

if (!function_exists('fetchModel')) {
    /**
     *
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     *
     * @return mixed|string
     * @author karam mustafa
     */
    function fetchModel($model)
    {
        if (is_string($model)) {
            return (new $model())->get();
        }
        return $model;
    }
}
if (!function_exists('userHasPermission')) {
    /**
     *
     *
     * @param  string  $permission
     *
     * @return mixed|string
     * @author karam mustafa
     */
    function userHasPermission($permission)
    {
        return auth()->user()->hasPermission($permission);
    }
}

if (!function_exists('getRouteJsonFile')) {
    /**
     *
     *
     * @return mixed|string
     * @throws PublicException
     * @author karam mustafa
     */
    function getRouteJsonFile()
    {
        return \Illuminate\Support\Facades\File::get(getRouteJsonPath());
    }
}
if (!function_exists('getRouteJsonPath')) {
    /**
     *
     *
     * @return mixed|string
     * @throws PublicException
     * @author karam mustafa
     */
    function getRouteJsonPath()
    {
        return base_path()."/routes/web.json";
    }
}

if (!function_exists('requestForApi')) {
    /**
     * this function to check if request has request body asked for json response for api
     * @return boolean
     * @throws PublicException
     * @author karam mustafa
     */
    function requestForApi()
    {
        try {
            return Route::current() != null && Route::current()->getPrefix() == 'api/';

        } catch (\Exception $e) {
            throw new PublicException(
                formatErrorMessage(__CLASS__, __LINE__, $e->getMessage())
            );
        }
    }

}
if (!function_exists('formatErrorMessage')) {
    /**
     * format error message for any exception
     *
     * @param $class
     * @param $line
     * @param $message
     *
     * @return string
     * @author karam mustafa
     */
    function formatErrorMessage($class, $line, $message)
    {
        return "Oops there is something went wrong in file ".$class." in Line ".$line." Details : ".$message;
    }
}

if (!function_exists('throwExceptionResponse')) {
    /**
     * this function determine if the request exception status for api or for web
     *
     * @param $class
     * @param $line
     * @param  string  $message
     * @param  bool  $useMessage
     *
     * @return mixed|string
     * @throws PublicException
     * @throws Exception
     * @author karam mustafa
     */
    function throwExceptionResponse($class = null, $line = null, $message = '', $useMessage = true)
    {
        $fullExceptionMessage = $useMessage
            ? $message
            : formatErrorMessage($class, $line, $message);
        if (requestForApi()) {
            throw new PublicException($fullExceptionMessage);
        } else {
            throw new Exception($fullExceptionMessage);
        }
    }
}

if (!function_exists('throwValidationException')) {
    /**
     * this function throw an error if there is any validation error during request
     *
     * @param $errors
     *
     * @return mixed|string
     * @throws PublicException
     * @author karam mustafa
     */
    function throwValidationException($errors)
    {
        if (requestForApi()) {
            throwExceptionResponse(null, null, collect($errors)->collapse(), true);
        }
        return redirect()->back()->withErrors($errors);
    }
}

if (!function_exists('saveImage')) {
    /**
     * @param  Object|array|mixed  $model
     * @param  Object  $request
     *
     * @param  null  $imageRequestName
     *
     * @return mixed
     * @throws \App\Exceptions\PublicException
     * @author karam mustafa
     */
    function saveImage($model = null, $request = null, $imageRequestName = null)
    {

        return saveFile(
            $request->all()[$imageRequestName]
            ?? $request[$imageRequestName], $imageRequestName, $model->imagePath,
            $model['id'] != null
                ? ['model' => $model, 'field' => $imageRequestName]
                : []
        );
    }
}
if (!function_exists('deleteImage')) {
    /**
     * @param  null  $path
     *
     * @return mixed
     * @author karam mustafa
     */
    function deleteImage($path = null)
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }
}

if (!function_exists('isUpdatedRequest')) {
    /**
     * this function to check if request is update request
     * @return bool
     * @author karam mustaf
     */
    function isUpdatedRequest()
    {
        return request()->isMethod("PUT") || request()->isMethod("PATCH");
    }
}
if (!function_exists('isGetRequest')) {
    /**
     * this function to check if request is get request
     * @return bool
     * @author karam mustaf
     */
    function isGetRequest()
    {
        return request()->isMethod("GET");
    }
}
if (!function_exists('isPostRequest')) {
    /**
     * this function to check if request is post request
     * @return bool
     * @author karam mustaf
     */
    function isPostRequest()
    {
        return request()->isMethod("POST");
    }
}
if (!function_exists('fixFieldsWithIgnoredFields')) {
    /**
     * this function is getting the model values and remove the keys that passing in getFields function
     * inside config -> ignoreInTable -> and pluck those keys
     * @param $fields
     *
     * @return void
     * @author karam mustaf
     */
    function fixFieldsWithIgnoredFields($fields)
    {
        $configs = $fields['config']['ignoreInTable'] ?? [];
        foreach ($configs as $ignoredKey) {
            unset($fields[$ignoredKey]);
        }
        return $fields;
    }
}
if (!function_exists('checkIfFiledHasFilter')) {
    /**
     * check if there is any filter apply in custom filed, then return the applied value on this field.
     *
     * @param $field
     *
     * @return string
     * @author karam mustaf
     */
    function checkIfFiledHasFilter($field)
    {
        return (request()->all()['isClearRequest'] ?? null) != "true" ?? false ?  request()->all()['filter'][$field] ?? '' : '';
    }
}
