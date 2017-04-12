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
        $question = $this->route('question');

        return [
            'title' => 'required|unique:questions,title,' . $question->id,
            'description' => 'required|min:3',
        ];
    }
}
