<?php

namespace App\Exceptions;

use App\Domain\ErrorCode;

class InvalidCredentialsException extends BaseException
{
    /**
     * @inheritDoc
     */
    public function statusCode()
    {
        return 401;
    }

    /**
     * @inheritDoc
     */
    public function errorCode()
    {
        return ErrorCode::INVALID_CREDENTIALS;
    }
}
