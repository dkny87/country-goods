<?php

namespace App\Exceptions;

use App\Domain\ErrorCode;

class InvalidClientCredentialsException extends BaseException
{
    /**
     * @inheritDoc
     */
    public function errorCode()
    {
        return ErrorCode::INVALID_CLIENT_CREDENTIALS;
    }

    /**
     * @inheritDoc
     */
    public function statusCode()
    {
        return 401;
    }
}