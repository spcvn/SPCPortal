<?php

namespace SPCVN\Http\Requests\Auth;

use SPCVN\Http\Requests\Request;

class PasswordRemindRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email',
        ];
    }
}
