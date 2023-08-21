<?php

namespace App\Http\Resources\Image;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{

    public function toArray($request)
    {
        return [
//            'title' => $this->resource->title,
//            'alt' => $this->resource->alt,
            'path' => $this->resource->path,
            'url' => $this->resource->url,
        ];
    }
}
