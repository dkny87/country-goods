<?php

namespace App\Domain;

class ErrorCode
{
    const INVALID_SESSION_TOKEN = 'invalid_session_token';
    const INVALID_CREDENTIALS = 'invalid_credentials';
    const INVALID_CLIENT_CREDENTIALS = 'invalid_client_credentials';
    const INVALID_PASSWORD = 'invalid_password';
    const VALIDATION_ERROR = 'validation_error';
}
