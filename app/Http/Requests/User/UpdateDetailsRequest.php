<?php

namespace SPCVN\Http\Requests\User;

use SPCVN\Http\Requests\Request;
use SPCVN\User;

class UpdateDetailsRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'birthday' => 'date',
            'role' => 'required|exists:roles,id'
        ];
    }
}
