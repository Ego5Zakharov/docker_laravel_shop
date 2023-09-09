<?php

namespace App\Console\Commands\Helpers;

use App\Models\Permission;

trait InstallPermissionsHelper
{
    private function createCategoryPermissions(): void
    {
        // categories
        Permission::query()
            ->firstOrCreate(['name' => 'index categories'])
            ->firstOrCreate(['name' => 'store categories'])
            ->firstOrCreate(['name' => 'update categories'])
            ->firstOrCreate(['name' => 'delete categories'])
            ->firstOrCreate(['name' => 'show categories']);
    }

    private function createUserPermissions(): void
    {
        // users
        Permission::query()
            ->firstOrCreate(['name' => 'index users'])
            ->firstOrCreate(['name' => 'show users'])
            ->firstOrCreate(['name' => 'create users'])
            ->firstOrCreate(['name' => 'attachPermissionsToUser users'])
            ->firstOrCreate(['name' => 'attachRolesToUser users']);
    }

    private function createRolePermissions(): void
    {
        // roles
        Permission::query()
            ->firstOrCreate(['name' => 'index roles'])
            ->firstOrCreate(['name' => 'show roles'])
            ->firstOrCreate(['name' => 'store roles'])
            ->firstOrCreate(['name' => 'create roles'])
            ->firstOrCreate(['name' => 'update roles'])
            ->firstOrCreate(['name' => 'detachPermissionFromRole roles']);
    }

    private function createPermissionPermissions(): void
    {
        // permissions
        Permission::query()
            ->firstOrCreate(['name' => 'index permissions'])
            ->firstOrCreate(['name' => 'store permissions'])
            ->firstOrCreate(['name' => 'show permissions'])
            ->firstOrCreate(['name' => 'update permissions'])
            ->firstOrCreate(['name' => 'getAllPermissionsWithId permissions'])
            ->firstOrCreate(['name' => 'delete permissions']);
    }

    private function createTagPermissions(): void
    {
        // tags
        Permission::query()
            ->firstOrCreate(['name' => 'index tags'])
            ->firstOrCreate(['name' => 'store tags'])
            ->firstOrCreate(['name' => 'show tags'])
            ->firstOrCreate(['name' => 'update tags'])
            ->firstOrCreate(['name' => 'delete tags']);
    }

    private function createProductPermissions(): void
    {
        // products
        Permission::query()
            ->firstOrCreate(['name' => 'index products'])
            ->firstOrCreate(['name' => 'create products'])
            ->firstOrCreate(['name' => 'show products'])
            ->firstOrCreate(['name' => 'update products'])
            ->firstOrCreate(['name' => 'delete products'])
            ->firstOrCreate(['name' => 'store products'])
            ->firstOrCreate(['name' => 'detachTag products'])
            ->firstOrCreate(['name' => 'delete deleteProductImage products'])
            ->firstOrCreate(['name' => 'deleteProductPreviewImage products'])
            ->firstOrCreate(['name' => 'changeProductPreviewImage products']);
    }
}
