<?php

namespace App\Http\Resources\Permission;

use App\Models\Permission;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property Permission */
class PermissionResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'description'=>$this->resource->description
        ];
    }
}
