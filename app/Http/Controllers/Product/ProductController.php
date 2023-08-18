<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Services\ProductService\Facades\ProductFacade;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        //
    }

    public function show()
    {
        //
    }

    public function store(CreateProductRequest $request)
    {
        $validated = $request->validated();

        return ProductResource::collection(ProductFacade::store($validated));
    }

    public function update(UpdateProductRequest $request)
    {
        //
    }

    public function delete()
    {
        //
    }
}
