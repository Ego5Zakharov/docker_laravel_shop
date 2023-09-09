<?php

namespace App\Actions\Roles;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class DetachPermissionFromRoleAction
{
    public function run(Role $role, Permission $permission): bool
    {
        return (bool)$role->permissions()->detach($permission->id);
    }
}
