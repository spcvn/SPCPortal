<?php

namespace SPCVN\Http\Requests\Tag;

use SPCVN\Http\Requests\Request;

class CreateTagRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'name' => 'required|regex:/^[a-zA-Z0-9\-_\.]+$/|unique:name'
        ];
    }
}
