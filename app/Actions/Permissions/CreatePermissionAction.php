<?php

namespace App\Actions\Permissions;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CreatePermissionAction
{
    public function run(PermissionData $data): Model|Builder
    {
        return Permission::query()->create([
                'name' => $data->name,
                'description' => $data->description ?? null
            ]
        );
    }
}
