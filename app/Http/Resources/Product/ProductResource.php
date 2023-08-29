<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Image\ImageResource;
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
            'article' => $this->resource->article,

            'preview_image' => $this->resource->preview_image_url,

            'category' => CategoryResource::make($this->resource->category),

            'images' => ImageResource::collection($this->resource->images),
            'tags' => TagResource::collection($this->resource->tags),
        ];
    }
}
