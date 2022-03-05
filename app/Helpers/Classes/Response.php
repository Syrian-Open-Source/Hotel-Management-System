<?php


namespace App\Helpers\Classes;


use App\Exceptions\PublicException;
use Illuminate\Contracts\Routing\ResponseFactory;

trait Response
{
    /**
     * @author karam mustafa
     * @var int
     */
    public int $SUCCESS_RESPONSE = 200;
    /**
     * @author karam mustafa
     * @var int
     */
    public int $ERROR_RESPONSE = 400;
    /**
     * @author karam mustafa
     * @var int
     */
    public int $SERVER_ERROR = 500;
    /**
     * @author karam mustafa
     * @var int
     */
    public int $VALIDATION_ERROR = 422;
    /**
     * @author karam mustafa
     * @var int
     */
    public int $AUTH_ERROR = 401;
    /**
     * @author karam mustafa
     * @var int
     */
    public int $FORBIDDEN_ERROR = 403;
    /**
     * @author karam mustafa
     * @var int
     */
    public int $NOT_FOUND = 404;


    /**
     * @author karam mustafa
     * @var mixed
     */
    public $message = "success response";

    /**
     * @author karam mustafa
     * @var boolean
     */
    public bool $error = false;
    /**
     * @author karam mustafa
     * @var string
     */
    public $status = 200;

    /**
     * @param  string|array  $message
     *
     * @return Response
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param  bool  $error
     *
     * @return Response
     */
    public function setError($error)
    {
        $this->error = $error;
        return $this;
    }

    /**
     * @param  string  $status
     *
     * @return Response
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * this function generate the response, and will determine if this response for api or blade file
     *
     * @param  string  $bladePage
     * @param  array  $compact
     * @param  null  $customRoute
     *
     * @param  bool  $back
     *
     * @return mixed
     * @throws \App\Exceptions\PublicException
     * @author karam mustafa
     */
    public function responseSuccess($compact = [], $bladePage = null, $customRoute = null, $back = false)
    {
        if ($customRoute != null && !requestForApi()) {
            return $back
                ? redirect()->back()
                : redirect()->route($customRoute, $compact);
        }
        if (requestForApi()) {
            return $this->getJsonResponse($compact);
        }

        return $compact != null ? view($bladePage, $compact) : view($bladePage);
    }

    /**
     * this function generate the error response, and will determine if this response for api or blade file
     *
     * @param  null  $data
     * @param  string  $message
     * @param  bool  $error
     * @param  int  $status
     *
     * @return mixed|string
     * @throws PublicException
     * @author karam mustafa
     */
    public function responseError($data = null, $message = 'error response', $error = true, $status = 400)
    {
        return requestForApi()
            ? $this
                ->setError($error)
                ->setMessage($message)
                ->setStatus($status)
                ->getJsonResponse($data)
            : throwExceptionResponse(null, null, $message);
    }

    /**
     * this function generate json response for api
     *
     * @param  null  $data
     *
     * @return ResponseFactory|Response
     * @throws PublicException
     * @author karam mustafa
     */
    public function getJsonResponse($data = null)
    {
        try {
            $data = $this->validateResponseBody($data);

            $arr = [
                // check if there are any exceptions, then we will return no data
                'resources' => in_array($this->status, $this->getSuccessState()) ? $data : null,
                // check if there are not any exceptions, then we will check if user pass any custom message
                // then we will return this message, otherwise we will return success message.
                'message' => $this->message,
                // check if we deal with error cases
                'error' => in_array($this->status, $this->getSuccessState()) ? false : $this->error,
                'status' => $this->status,
            ];

            return response($arr, $arr['status']);

        } catch (\Exception $e) {
            return throwExceptionResponse(__CLASS__, __LINE__, $e->getMessage());
        }
    }


    /**
     * success status code
     *
     * @return array
     * @author karam mustafa
     */
    public function getSuccessState()
    {
        return [200, 201, 202];
    }

    /**
     * description
     *
     * @param $data
     *
     * @return null
     * @author karam mustafa
     */
    private function validateResponseBody($data)
    {
        if (gettype($this->error) == 'integer') {
            $this->setStatus($this->error);
        }

        if (gettype($data) == 'string') {
            $this->setMessage($data);
            $data = null;
        }
        return $data;
    }
}
