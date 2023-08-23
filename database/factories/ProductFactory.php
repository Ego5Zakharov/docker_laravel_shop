<?php

namespace Database\Factories;

use App\Models\Category;
use App\Services\ProductService\Helpers\productHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    use productHelper;

    public function definition()
    {
        return [
            'title' => $this->withFaker()->sentence,
            'description' => $this->withFaker()->text,
            'quantity' => $this->withFaker()->numberBetween(40, 100),
            'price' => $this->withFaker()->numberBetween(10000, 100000),
            'is_published' => true,
            'article' => $this->generateArticle(),
            'category_id' => Category::factory(),
        ];
    }
}
