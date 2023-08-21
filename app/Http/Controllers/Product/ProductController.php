<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Services\ProductService\Facades\ProductFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return ProductResource::collection(
            ProductFacade::index()
        );
    }

    public function show(Product $product): ProductResource
    {
        return ProductResource::make(
            ProductFacade::show($product)
        );
    }

    public function store(CreateProductRequest $request): ProductResource
    {
        $validated = $request->validated();

        return ProductResource::make(
            ProductFacade::store($validated)
        );
    }

    public function update(UpdateProductRequest $request, Product $product): ProductResource
    {
        $validated = $request->validated();

        return ProductResource::make(
            ProductFacade::update($validated, $product)
        );
    }

    public function delete(Product $product): JsonResponse
    {
        if (ProductFacade::delete($product)) {
            return response()->json(['message' => 'deleted'], 204);
        }

        return response()->json(['message' => 'Failed to delete product', 500]);
    }
}
