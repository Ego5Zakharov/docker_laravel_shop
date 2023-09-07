<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
    use HandlesAuthorization;

    public function index(User $user): bool
    {
        return $user->hasPermissionTo('index tags');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create tags');
    }

    public function show(User $user): bool
    {
        return $user->hasPermissionTo('show tags');
    }

    public function update(User $user): bool
    {
        return $user->hasPermissionTo('update tags');
    }

    public function delete(User $user): bool
    {
        return $user->hasPermissionTo('update tags');
    }
}
