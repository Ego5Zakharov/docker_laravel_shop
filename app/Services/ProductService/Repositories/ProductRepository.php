<?php


namespace App\Services\ProductService\Repositories;

use App\Models\Product;
use App\Services\ProductService\Helpers\productHelper;

class ProductRepository
{
    use productHelper;

    public function index()
    {

    }

    public function show()
    {
        //
    }

    public function store(array $data)
    {
        dd($this->loadFiles($data['images']));

        $product = Product::query()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'category_id' => $data['category_id'],
            'is_published' => $data['is_published'],
            'tags' => $data['tags'],
            'article' => self::generateArticle(),
        ]);

        $product->tags()->attach($data['tags']);

        dd($product);
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
