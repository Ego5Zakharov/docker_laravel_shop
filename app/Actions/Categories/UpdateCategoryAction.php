<?php

namespace App\Actions\Categories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UpdateCategoryAction
{
    public function run(CategoryData $data, Category $category): Model|Collection|Builder|array|null
    {
        $category->query()->update(['title' => $data->title]);

        return Category::query()->find($category->id);
    }
}
