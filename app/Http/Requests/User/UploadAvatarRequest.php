<?php

namespace SPCVN\Http\Requests\User;

use SPCVN\Http\Requests\Request;
use SPCVN\User;

class UploadAvatarRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => 'required|image'
        ];
    }
}
