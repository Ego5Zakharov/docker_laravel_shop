<?php

namespace App\Http\Controllers;

use App\Actions\Categories\CategoryData;
use App\Actions\Categories\CreateCategoryAction;
use App\Actions\Categories\DeleteCategoryAction;
use App\Actions\Categories\UpdateCategoryAction;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return CategoryResource::collection(Category::query()->get());
    }

    public function store(CreateCategoryRequest $request): CategoryResource
    {
        $validatedData = $request->validated();

        return CategoryResource::make(
            (new CreateCategoryAction)->run(new CategoryData(title: $validatedData['title']))
        );
    }

    public function show(Category $category): CategoryResource
    {
        return CategoryResource::make($category);
    }

    public function update(Category $category, UpdateCategoryRequest $request): CategoryResource
    {
        $validatedData = $request->validated();
        return CategoryResource::make(
            (new UpdateCategoryAction)->run(new CategoryData(title: $validatedData['title']), $category)
        );
    }

    public function delete(Category $category): JsonResponse
    {
        (new DeleteCategoryAction)->run($category);

        return response()->json(['message' => 'deleted'], 204);
    }
}
