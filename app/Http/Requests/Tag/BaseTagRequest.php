<?php

namespace SPCVN\Http\Requests\Tag;

use SPCVN\Http\Requests\Request;

class BaseTagRequest extends Request
{
    public function rules()
    {
        return [];
    }

    /**
     * Validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.unique' => trans('app.permission_already_exists')
        ];
    }
}
