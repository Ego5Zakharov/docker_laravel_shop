<?php

namespace App\Services\ProductService;

use App\Models\Product;
use App\Services\ProductService\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(): LengthAwarePaginator
    {
        return $this->productRepository->index();
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
}
