<?php

namespace App\Exceptions;

use App\Domain\ErrorMessage;
use Exception;

abstract class BaseException extends Exception
{
    /**
     * @return string
     */
    abstract public function errorCode();

    /**
     * @return int
     */
    abstract public function statusCode();

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request)
    {
        $errorCode = $this->errorCode();

        return response()->json([
            'code' => $errorCode,
            'message' => ErrorMessage::forCode($errorCode),
        ], $this->statusCode());
    }
}
