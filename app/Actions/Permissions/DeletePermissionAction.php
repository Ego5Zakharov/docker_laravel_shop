<?php

namespace App\Actions\Permissions;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class DeletePermissionAction
{
    public function run(Permission $permission): bool
    {
        return $permission->delete();
    }
}
