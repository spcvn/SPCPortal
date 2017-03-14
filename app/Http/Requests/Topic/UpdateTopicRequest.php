<?php

namespace SPCVN\Http\Requests\Topic;

use SPCVN\Http\Requests\Request;

class UpdateTopicRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $topic = $this->route('topic');

        return [
             'category_id'   => 'required:topics,category_id,'. $topic->id,
             'topic_name'    => 'required|regex:/^[a-zA-Z][a-zA-Z0-9.,$;]+$/|unique:topics,topic_name,'. $topic->id
            //'topic_name'    => 'required'
        ];
    }
}
