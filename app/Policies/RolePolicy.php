<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function index(User $user): bool
    {
        return $user->hasPermissionTo('index roles');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create roles');
    }

    public function show(User $user): bool
    {
        return $user->hasPermissionTo('show roles');
    }

    public function store(User $user): bool
    {
        return $user->hasPermissionTo('store roles');
    }

    public function update(User $user): bool
    {
        return $user->hasPermissionTo('update roles');
    }

    public function delete(User $user): bool
    {
        return $user->hasPermissionTo('delete roles');
    }

    public function detachPermissionFromRole(User $user): bool
    {
        return $user->hasPermissionTo('detachPermissionFromRole roles');
    }
}
