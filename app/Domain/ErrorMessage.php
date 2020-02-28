<?php

namespace App\Domain;

use InvalidArgumentException;

/**
 * Class ErrorMessage
 * @package App\Domain
 */
class ErrorMessage
{
    /**
     * @var array
     */
    private static $messages = [
        ErrorCode::INVALID_SESSION_TOKEN => 'Invalid session token.',
        ErrorCode::INVALID_CREDENTIALS => 'Invalid e-mail or password.',
        ErrorCode::INVALID_CLIENT_CREDENTIALS => 'Invalid client credentials.',
        ErrorCode::INVALID_PASSWORD => 'Invalid password.',
        ErrorCode::VALIDATION_ERROR => 'The given data was invalid.',
    ];

    /**
     * @param $errorCode
     * @return mixed
     */
    public static function forCode($errorCode)
    {
        if (!array_key_exists($errorCode, static::$messages)) {
            throw new InvalidArgumentException('Invalid error code.');
        }

        return static::$messages[$errorCode];
    }
}
