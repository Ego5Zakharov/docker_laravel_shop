<?php

namespace App\Http\Resources\Role;

use App\Http\Resources\Permission\PermissionResource;
use App\Models\Role;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Role $resource
 */
class RoleResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'permissions' => PermissionResource::collection($this->resource->permissions),
        ];
    }
}
