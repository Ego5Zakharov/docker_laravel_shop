<?php


namespace App\Services\ProductService\Repositories;

use App\Models\Product;
use App\Services\ProductService\Helpers\productFileUploader;
use App\Services\ProductService\Helpers\productHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository
{
    use productHelper, productFileUploader;

    public function index(): LengthAwarePaginator
    {
        $perPage = 12;

        return Product::query()->with([
            'images', 'tags', 'category'
        ])->paginate($perPage);
    }

    public function show(Product $product): Model|Builder
    {
        return $product::query()
            ->where('id', $product->id)
            ->with(['images', 'tags', 'category'])
            ->first();
    }

    public function store(array $data): Model|Builder
    {
        $product = Product::query()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'category_id' => $data['category_id'],
            'is_published' => $data['is_published'],
            'article' => $this->generateArticle(),
        ]);

        $product->tags()->attach($data['tags']);
        $this->loadFiles($data['images'], $product);

        return $product;
    }

    public function update(array $data, Product $product): Model|Builder
    {
        $product::query()->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'is_published' => $data['is_published'],
            'category_id' => $data['category_id'],
        ]);

        $this->loadFiles($data['images'], $product);
        $product->tags()->attach($data['tags']);

        return $product;
    }

    public function delete(Product $product): bool
    {
        $this->deleteProductImages($product);
        $product->tags()->detach();
        $product->delete();

        return true;
    }
}
