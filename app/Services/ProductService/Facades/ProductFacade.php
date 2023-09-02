<?php

namespace App\Services\ProductService\Facades;

use App\Models\Product;
use App\Services\ProductService\Repositories\ProductRepository;
use Illuminate\Support\Facades\Facade;


/**
 * @see ProductRepository
 */
/**
 * @method static update(array $validated, Product $product)
 * @method static store(array $validated)
 * @method static delete(Product $product)
 * @method static index(array $validated)
 * @method static show(Product $product)
 * @method static create()
 * @method static detachTag(Product $product, \App\Models\Tag $tag)
 * @method static deleteProductImage(Product $product, \App\Models\Image $image)
 * @method static deleteProductPreviewImage(Product $product)
 * @method static changeProductPreviewImageDB(Product $product, \App\Models\Image $image)
 */
class ProductFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'productService';
    }
}
