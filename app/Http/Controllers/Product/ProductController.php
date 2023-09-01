<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\IndexProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Products\CreateProductDataResource;
use App\Models\Product;
use App\Services\ProductService\Facades\ProductFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    public function index(IndexProductRequest $request): AnonymousResourceCollection
    {
        $data = $request->validated();

        return ProductResource::collection(
            ProductFacade::index($data)
        );
    }

    public function create()
    {
        return CreateProductDataResource::make(ProductFacade::create());
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
//        dd($validated);
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
