<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{
    public function saving(Category $category)
    {
        $category->slug = str($category->name)->slug('-','ru');
    }
}
