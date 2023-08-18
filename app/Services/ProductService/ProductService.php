<?php

namespace App\Services\ProductService;

use App\Services\ProductService\Repositories\ProductRepository;

class ProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {

    }

    public function show()
    {
        //
    }

    public function store(array $data)
    {
        return $this->productRepository->store($data);
    }

    public function update()
    {
        //
    }

    public function delete()
    {
        //
    }
}
