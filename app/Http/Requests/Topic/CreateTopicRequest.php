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
            'topic_name'    => 'required|min:3|max:250|regex:/^[^!<>%$`~=+;\\\:\/\{\}\[\]#@&\(\)?"\']*$/',
            //'picture'       => 'mimes:jpeg,jpg,png,gif,bmp',
            'document'      => 'max:10000'
        ];
    }
}
