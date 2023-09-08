<?php

namespace App\Actions\Roles;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UpdatePermissionAction
{
    public function run(PermissionData $data, Permission $permission): Permission
    {
        $permission->update([
            'name' => $data->name,
            'description' => $data->description,
        ]);

        return $permission->refresh();
    }
}
