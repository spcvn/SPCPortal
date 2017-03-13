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
            'topic_name' => 'required|unique:topics,topic_name,' . $topic->id
        ];
    }
}
