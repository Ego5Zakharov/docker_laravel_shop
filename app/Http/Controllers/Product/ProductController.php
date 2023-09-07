<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\IndexProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Image\ImageResource;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Products\CreateProductDataResource;
use App\Models\Image;
use App\Models\Product;
use App\Models\Tag;
use App\Services\ProductService\Facades\ProductFacade;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(IndexProductRequest $request): AnonymousResourceCollection
    {
        $this->authorize('index', Product::class);

        $data = $request->validated();

        return ProductResource::collection(
            ProductFacade::index($data)
        );
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): CreateProductDataResource
    {
        $this->authorize('create', Product::class);

        return CreateProductDataResource::make(ProductFacade::create());
    }

    /**
     * @throws AuthorizationException
     */
    public function show(Product $product): ProductResource
    {
        $this->authorize('show', Product::class);

        return ProductResource::make(
            ProductFacade::show($product)
        );
    }

    /**
     * @throws AuthorizationException
     */
    public function store(CreateProductRequest $request): ProductResource
    {
        $this->authorize('store', Product::class);

        $validated = $request->validated();
        return ProductResource::make(
            ProductFacade::store($validated)
        );
    }

    /**
     * @throws AuthorizationException
     */
    public function update(UpdateProductRequest $request, Product $product): ProductResource
    {
        $this->authorize('update', Product::class);

        $validated = $request->validated();

        return ProductResource::make(
            ProductFacade::update($validated, $product)
        );
    }


    /**
     * @throws AuthorizationException
     */
    public function delete(Product $product): JsonResponse
    {
        $this->authorize('delete', Product::class);

        if (ProductFacade::delete($product)) {
            return response()->json(['message' => 'deleted'], 204);
        }

        return response()->json(['message' => 'Failed to delete product', 500]);
    }

    /**
     * @throws AuthorizationException
     */
    public function detachTag(Product $product, Tag $tag)
    {
        $this->authorize('detachTag', Product::class);

        return ProductFacade::detachTag($product, $tag);
    }

    /**
     * @throws AuthorizationException
     */
    public function deleteProductImage(Product $product, Image $image)
    {
        $this->authorize('deleteProductImage', Product::class);

        return ProductFacade::deleteProductImage($product, $image);
    }

    /**
     * @throws AuthorizationException
     */
    public function deleteProductPreviewImage(Product $product)
    {
        $this->authorize('deleteProductPreviewImage', Product::class);

        return ProductFacade::deleteProductPreviewImage($product);
    }

    /**
     * @throws AuthorizationException
     */
    public function changeProductPreviewImage(Product $product, Image $image): JsonResponse
    {
        $this->authorize('changeProductPreviewImage', Product::class);

        if (($changePreviewImage = ProductFacade::changeProductPreviewImageDB($product, $image)) === null) {
            return response()->json(['message' => 'preview_image_url or preview_image_path не определен(ы)']);
        }
        return response()->json(['data' => $changePreviewImage]);
    }
}
