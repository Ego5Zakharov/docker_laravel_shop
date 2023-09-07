<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Role\RoleResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property User $resource */
class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'email' => $this->resource->email,
            'name' => $this->resource->name,
            'roles' => RoleResource::collection($this->resource->roles)
        ];
    }
}
