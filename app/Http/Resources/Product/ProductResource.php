<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Tag\TagResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Product $resource
 */
class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'description' => $this->resource->description,
            'price' => $this->resource->price,
            'quantity' => $this->resource->quantity,
            'is_published' => $this->resource->is_published,
            'article'=>$this->resource->article
            
//            'images'=> ImagesResource::collection($this->resource->images),
//            'category' => CategoryResource::make($this->resource->category),
//            'tags' => TagResource::collection($this->resource->tags),
        ];
    }
}
