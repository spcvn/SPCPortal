<?php

namespace SPCVN\Http\Requests\Topic;

use SPCVN\Http\Requests\Request;

class CreateTopicRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id'   => 'required:topics,category_id',
            'topic_name'    => 'required|regex:/^[a-zA-Z0-9\-_\.]+$/|unique:topics,topic_name'
        ];
    }
}
