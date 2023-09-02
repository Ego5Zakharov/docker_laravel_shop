<?php

namespace App\Services\ProductService;

use App\Models\Image;
use App\Models\Product;
use App\Models\Tag;
use App\Services\ProductService\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function create(): Collection
    {
        return $this->productRepository->create();
    }

    public function index(array $data): LengthAwarePaginator
    {
        return $this->productRepository->index($data);
    }

    public function show(Product $product)
    {
        return $this->productRepository->show($product);
    }

    public function store(array $data): Model|Builder
    {
        return $this->productRepository->store($data);
    }

    public function update(array $data, Product $product): Model|Builder
    {
        return $this->productRepository->update($data, $product);
    }

    public function delete(Product $product): bool
    {
        return $this->productRepository->delete($product);
    }

    public function detachTag(Product $product, Tag $tag): void
    {
        $this->productRepository->detachTag($product, $tag);
    }

    public function deleteProductImage(Product $product, Image $image): void
    {
        $this->productRepository->deleteProductImage($product, $image);
    }

    public function deleteProductPreviewImage(Product $product): void
    {
        $this->productRepository->deleteProductPreviewImage($product);
    }

    public function changeProductPreviewImageDB(Product $product, Image $image): ?array
    {
        return $this->productRepository->changeProductPreviewImage($product, $image);
    }
}
