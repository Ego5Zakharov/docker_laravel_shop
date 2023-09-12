<?php

namespace App\Services\SearchProductService\Actions;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchProductsAction
{
    private null|string $search_field;

    public function run(): LengthAwarePaginator
    {
        return Product::query()
            ->where('title', 'like', '%' . $this->search_field . '%')
            ->orWhere('description', 'like', '%' . $this->search_field . '%')
            ->orWhere('price', 'like', '%' . $this->search_field . '%')
            ->orWhereHas('category', function ($query) {
                $query->orWhere('title', 'like', '%' . $this->search_field . '%');
            })->orWhereHas('tags', function ($query) {
                $query->orWhere('title', 'like', '%' . $this->search_field . '%');
            })->paginate(6);
    }

    public function setSearchField(string $search_field): self
    {
        $this->search_field = $search_field;

        return $this;
    }
}
