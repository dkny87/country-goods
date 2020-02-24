<?php

namespace App\Http\Requests;

use App\Domain\{ErrorCode, ErrorMessage};
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class BaseRequest extends FormRequest
{
    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $response = [
            'code' => ErrorCode::VALIDATION_ERROR,
            'message' => ErrorMessage::forCode(ErrorCode::VALIDATION_ERROR),
            'errors' => $validator->errors()->messages(),
        ];

        throw new HttpResponseException(response()->json($response, 422));
    }
}
