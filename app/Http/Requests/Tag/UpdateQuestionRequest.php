<?php

namespace SPCVN\Http\Requests\Tag;

use SPCVN\Http\Requests\Request;

class UpdateTagRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $tag = $this->route('tag');

        return [
            'name' => 'required|regex:/^[a-zA-Z0-9\-_\.]+$/|unique:roles,name,' . $role->id
        ];
    }
}
