<?php

namespace App\Actions\Roles;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CreateRoleAction
{
    public function run(RoleData $data): Builder|Model
    {
        $role = Role::query()->create([
            'name' => $data->name
        ]);

        if (isset($role) && isset($data->permissions)) {
            $role->permissions()->attach($data->permissions);
        }

        return $role;
    }
}
