<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function index(User $user): bool
    {
        return $user->hasPermissionTo('index users');
    }

    public function show(User $user): bool
    {
        return $user->hasPermissionTo('show users');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create users');
    }


    public function attachRolesToUser(User $user): bool
    {
        return $user->hasPermissionTo('attachRolesToUser users');
    }

    public function attachPermissionsToUser(User $user): bool
    {
        return $user->hasPermissionTo('attachPermissionsToUser users');
    }

    public function detachPermissionFromUser(User $user): bool
    {
        return $user->hasPermissionTo('detachPermissionFromUser users');

    }

    public function detachRoleFromUser(User $user): bool
    {
        return $user->hasPermissionTo('detachRoleFromUser users');

    }

}
