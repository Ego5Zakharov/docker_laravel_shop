<?php

namespace App\Actions\Roles;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UpdateRoleAction
{
    public function run(RoleData $data, Role $role): Role
    {
        if (isset($data->name))
            $role->update([
                'name' => $data->name
            ]);

        if (isset($data->permissions)) {
            $role->permissions()->syncWithoutDetaching($data->permissions);
        }

        return $role;
    }
}
