<?php


namespace App\Services\ProductService\Repositories;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Tag;
use App\Services\ProductService\Helpers\productFileUploader;
use App\Services\ProductService\Helpers\productRepositoryHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ProductRepository
{
    use productRepositoryHelper, productFileUploader;


    public function index(array $data): LengthAwarePaginator
    {
        $perPage = 3;

        $products = Product::query()->with(['images', 'tags', 'category']);

        return $products->paginate($perPage, ['*'], pageName: 'page', page: $data['page']);
    }

    public function create(): Collection
    {
        $categories = Category::query()->get(['id', 'title'])->all();
        $tags = Tag::query()->get(['id', 'title'])->all();

        return collect([
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    public function show(Product $product): Model|Builder
    {
        return $product::query()
            ->where('id', $product->id)
            ->with(['images', 'tags', 'category'])
            ->first();
    }

    public function store(array $data): Model|Builder|null
    {
        $product = null;

        transaction(function () use ($data, &$product) {
            $product = Product::query()->create([
                'title' => $data['title'],
                'description' => $data['description'],
                'price' => $data['price'],
                'quantity' => $data['quantity'],
                'category_id' => $data['category_id'],
                'is_published' => $data['is_published'],
                'article' => $this->generateArticle(),
            ]);

            $this->addTagIfItDoesntExists($data['tags'] ?? null, $product);

            $this->loadFiles($data['images'] ?? null, $product);

            $this->createProductFile($data['preview_image_path'] ?? null, $product, isPreview: true);

            return $product;
        });
        return $product;
    }

    public function update(array $data, Product $product): Model|Builder
    {
        $result = null;

        transaction(function () use ($data, &$product, &$result) {

            $product = $product->fill([
                'title' => $data['title'],
                'description' => $data['description'],
                'price' => $data['price'],
                'quantity' => $data['quantity'],
                'category_id' => $data['category_id'],
                'is_published' => $data['is_published'],
            ]);

            $product->save();

            $this->addTagIfItDoesntExists($data['tags'] ?? null, $product);

            $this->loadFiles($data['images'] ?? null, $product);

            $this->createProductFile($data['preview_image_path'] ?? null, $product, true);

            $result = $product;

            return $product;
        });
        return $result;
    }

    public function delete(Product $product): bool
    {
        return transaction(function () use ($product) {
            $this->deleteProductImages($product);
            $product->tags()->detach();
            $product->delete();

            return true;
        });
    }

    public function detachTag(Product $product, Tag $tag): void
    {
        if (!$product->tags->contains($tag)) {
            throw new \InvalidArgumentException('Тег не связан с данным товаром');
        }
        $product->tags()->detach($tag->id);
    }

    public function deleteProductImage(Product $product, Image $image): void
    {
        if (!$product->images->contains($image)) {
            throw new \InvalidArgumentException('Картинка не связана с данным товаром');
        }
        $this->deleteProductImageDB($product, $image);
    }

    public function deleteProductPreviewImage(Product $product): void
    {
        $this->deleteProductPreviewImageDB($product);
    }

    public function changeProductPreviewImage(Product $product, Image $image): ?array
    {
        return $this->changeProductPreviewImageDB($product, $image);
    }
}
