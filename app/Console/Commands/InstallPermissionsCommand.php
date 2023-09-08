<?php

namespace App\Console\Commands;

use App\Console\Commands\Helpers\InstallPermissionsHelper;
use App\Enums\RoleEnum;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Console\Command;

class InstallPermissionsCommand extends Command
{
    use InstallPermissionsHelper;

    protected $signature = 'permissions:install';

    public function handle(): void
    {
        $this->warn('Установка разрешений для ролей');

        $this->installPermissions();

        $this->info('Разрешения установлены');
    }

    private function installPermissions(): void
    {
        $this->createPermissionsForAdmin();
    }

    private function createPermissionsForAdmin(): void
    {
        $this->createTagPermissions();
        $this->createCategoryPermissions();
        $this->createProductPermissions();
        $this->createUserPermissions();
        $this->createRolePermissions();
        $this->createPermissionPermissions();

        $allPermissions = Permission::query()->get();

        $admin = Role::query()->where('name', RoleEnum::admin->name)->first();

        foreach ($allPermissions as $permission) {
            if (!$admin->permissions->contains('id', $permission->id)) {
                $admin->permissions()->attach($permission->id);
            }
        }

    }


}
