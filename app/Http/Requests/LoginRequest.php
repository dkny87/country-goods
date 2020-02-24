<?php

namespace App\Http\Requests;

use App\ValueObjects\Password;

class LoginRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'admin_email' => [
                'required',
                'email'
            ],
            'admin_password' => [
                'required',
                'min:' . Password::MIN,
                'max:' . Password::MAX,
            ],
            'remember' => [
                'nullable',
                'boolean'
            ]
        ];
    }
}
