<?php

namespace App\Http\Controllers;

use App\Actions\Categories\CategoryData;
use App\Actions\Categories\CreateCategoryAction;
use App\Actions\Categories\DeleteCategoryAction;
use App\Actions\Categories\UpdateCategoryAction;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\IndexCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(IndexCategoryRequest $request): AnonymousResourceCollection
    {
        $this->authorize('index', Category::class);
        $data = $request->validated();

        $perPage = 5;

        $categories = Category::query()->paginate($perPage, ['*'], 'page', $data['page']);

        return CategoryResource::collection($categories);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(CreateCategoryRequest $request): CategoryResource
    {
        $this->authorize('create', Category::class);

        $validatedData = $request->validated();

        return CategoryResource::make(
            (new CreateCategoryAction)->run(new CategoryData(title: $validatedData['title']))
        );
    }

    /**
     * @throws AuthorizationException
     */
    public function show(Category $category): CategoryResource
    {
        $this->authorize('show', $category);

        return CategoryResource::make($category);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Category $category, UpdateCategoryRequest $request): CategoryResource
    {
        $this->authorize('update', Category::class);

        $validatedData = $request->validated();
        return CategoryResource::make(
            (new UpdateCategoryAction)->run(new CategoryData(title: $validatedData['title']), $category)
        );
    }

    /**
     * @throws AuthorizationException
     */
    public function delete(Category $category): JsonResponse
    {
        $this->authorize('delete', Category::class);

        (new DeleteCategoryAction)->run($category);

        return response()->json(['message' => 'deleted'], 204);
    }
}
