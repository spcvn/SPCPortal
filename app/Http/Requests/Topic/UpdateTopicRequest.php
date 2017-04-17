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
             'topic_name'    => 'required|min:3|max:250|regex:/^[^!<>%$`~=+;\\\:\/\{\}\[\]#@&\(\)?"\']*$/|unique:topics,topic_name,'. $topic->id,
             //'picture'       => 'mimes:jpeg,jpg,png,gif,bmp',
             'document'      => 'max:10000'
        ];
    }
}
