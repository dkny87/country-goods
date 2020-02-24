<?php

namespace App\Http\Requests;

use App\ValueObjects\Password;

/**
 * Class AdminUpdateRequest
 * @package App\Http\Requests
 */
class UpdatePasswordRequest extends BaseRequest
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
            'current_admin_password' => ['required'],
            'new_admin_password' => [
                'required',
                'confirmed',
                'min:' . Password::MIN,
                'max:' . Password::MAX
            ],
            'new_admin_password_confirmation' => ['required']
        ];
    }
}
