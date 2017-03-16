<?php

namespace SPCVN\Http\Requests\Category;

use SPCVN\Http\Requests\Request;

class UpdateCategoryRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $category = $this->route('category');

        return [
            'name' => 'required|unique:categories,name,' . $category->id
        ];
    }
}
