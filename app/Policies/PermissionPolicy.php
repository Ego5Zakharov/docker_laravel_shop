<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    public function index(User $user): bool
    {
        return $user->hasPermissionTo('index permissions');
    }

    public function show(User $user): bool
    {
        return $user->hasPermissionTo('show permissions');
    }

    public function store(User $user): bool
    {
        return $user->hasPermissionTo('store permissions');
    }

    public function update(User $user): bool
    {
        return $user->hasPermissionTo('update permissions');
    }

    public function delete(User $user): bool
    {
        return $user->hasPermissionTo('delete permissions');
    }

    public function getAllPermissionsWithId(User $user): bool
    {
        return $user->hasPermissionTo('getAllPermissionsWithId permissions');
    }


}

