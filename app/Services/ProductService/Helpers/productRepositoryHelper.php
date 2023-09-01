<?php


namespace App\Services\ProductService\Helpers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait productRepositoryHelper
{
    public function generateArticle(int $length = 8): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

    public function getProductByModel(Product $product)
    {
        return Product::query()
            ->find($product->id)
            ->with(['images', 'tags', 'category'])
            ->first();
    }

    public function addTagIfItDoesntExists(?array $data, Product $product): bool
    {
        if(!isset($data)){
           return false;
        }
        $tagsToAdd = $data;

        foreach ($tagsToAdd as $tagId) {
            if (!$product->tags->contains($tagId)) {
                $product->tags()->attach($tagId);
            }
        }
        return true;
    }

    public function deleteProductImages(Product $product): bool
    {
        if (!$product->images()->exists()) {
            return false;
        }

        foreach ($product->images as $image) {
            Storage::delete($image->path);
        }

        $product->images()->delete();

        return true;
    }
}
