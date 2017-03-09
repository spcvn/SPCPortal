<?php

namespace SPCVN\Http\Requests\Category;

use SPCVN\Http\Requests\Request;

class CreateCategoryRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:categories,name'
        ];
    }
}