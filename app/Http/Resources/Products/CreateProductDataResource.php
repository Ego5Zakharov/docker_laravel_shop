<?php

namespace App\Http\Resources\Products;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Tag\TagResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateProductDataResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'categories' => $this->resource, // categories
            'tags' => $this->resource, // tags
        ];
    }
}
