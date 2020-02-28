<?php

namespace App\Exceptions;

use App\Domain\ErrorMessage;
use Exception;
use Illuminate\Http\JsonResponse;

abstract class BaseException extends Exception
{
    /**
     * @param $request
     * @return JsonResponse
     */
    public function render($request)
    {
        $errorCode = $this->errorCode();

        return response()->json([
            'code' => $errorCode,
            'message' => ErrorMessage::forCode($errorCode),
        ], $this->statusCode());
    }

    /**
     * @return string
     */
    abstract public function errorCode();

    /**
     * @return int
     */
    abstract public function statusCode();
}
