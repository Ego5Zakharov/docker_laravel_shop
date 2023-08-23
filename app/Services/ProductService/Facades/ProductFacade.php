<?php

namespace App\Services\ProductService\Facades;

use App\Models\Product;
use Illuminate\Support\Facades\Facade;


/**
 * @method static update(array $validated, Product $product)
 * @method static store(array $validated)
 * @method static delete(Product $product)
 * @method static index()
 * @method static show(Product $product)
 */
class ProductFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'productService';
    }
}
