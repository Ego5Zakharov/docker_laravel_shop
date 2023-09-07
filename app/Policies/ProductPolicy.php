<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function index(User $user): bool
    {
        return $user->hasPermissionTo('index products');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create products');
    }

    public function show(User $user): bool
    {
        return $user->hasPermissionTo('show products');
    }

    public function store(User $user): bool
    {
        return $user->hasPermissionTo('store products');
    }

    public function update(User $user): bool
    {
        return $user->hasPermissionTo('update products');
    }

    public function delete(User $user): bool
    {
        return $user->hasPermissionTo('delete products');
    }

    public function detachTag(User $user): bool
    {
        return $user->hasPermissionTo('detachTag products');
    }

    public function deleteProductImage(User $user): bool
    {
        return $user->hasPermissionTo('deleteProductImage products');
    }

    public function deleteProductPreviewImage(User $user): bool
    {
        return $user->hasPermissionTo('deleteProductPreviewImage products');
    }

    public function changeProductPreviewImage(User $user): bool
    {
        return $user->hasPermissionTo('changeProductPreviewImage products');
    }
}
