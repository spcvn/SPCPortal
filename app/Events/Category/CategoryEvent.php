<?php

namespace SPCVN\Events\Category;

use SPCVN\Category;

abstract class CategoryEvent
{
    /**
     * @var Category
     */
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return Permission
     */
    public function getCategory()
    {
        return $this->category;
    }
}