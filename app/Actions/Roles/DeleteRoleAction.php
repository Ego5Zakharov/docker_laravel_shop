<?php

namespace App\Actions\Roles;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class DeleteRoleAction
{
    public function run(Role $role): bool
    {
        return $role->delete();
    }
}
