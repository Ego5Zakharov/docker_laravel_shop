<?php

namespace App\Actions\Categories;

use App\Models\Category;
use App\Models\Product;

class DeleteCategoryAction
{
    public function run(Category $category): void
    {
        transaction(function () use ($category) {
            Product::query()
                ->where('category_id', $category->id)
                ->update(['category_id' => null]);
            
            $category->delete();
        });
    }
}
