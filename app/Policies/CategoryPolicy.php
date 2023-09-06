<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function index(User $user): bool
    {
        return $user->hasPermissionTo('index categories');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create categories');
    }

    public function show(User $user): bool
    {
        return $user->hasPermissionTo('show categories');
    }

    public function update(User $user): bool
    {
        return $user->hasPermissionTo('update categories');
    }

    public function delete(User $user): bool
    {
        return $user->hasPermissionTo('delete categories');
    }
}
