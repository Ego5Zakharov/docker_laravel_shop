<?php

namespace App\Actions\Categories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CreateCategoryAction
{
    public function run(CategoryData $data): Model|Builder
    {
        return Category::query()->create(['title' => $data->title]);
    }
}
