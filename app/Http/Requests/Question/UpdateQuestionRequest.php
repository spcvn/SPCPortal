<?php

namespace SPCVN\Http\Requests\Question;

use SPCVN\Http\Requests\Request;

class UpdateQuestionRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $role = $this->route('role');

        return [
            'title' => 'required|regex:/^[a-zA-Z0-9\-_\.]+$/|unique:roles,title,' . $role->id
        ];
    }
}
