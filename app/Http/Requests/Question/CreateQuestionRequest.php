<?php

namespace SPCVN\Http\Requests\Question;

use SPCVN\Http\Requests\Request;

class CreateQuestionRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'     => 'required',
            'topic_id'  => 'required',
            'user_id'   => 'required'
        ];
    }
}
