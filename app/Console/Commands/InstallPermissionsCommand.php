<?php

namespace App\Console\Commands;

use App\Enums\RoleEnum;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\PHP;

class InstallPermissionsCommand extends Command
{

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

        $allPermissions = Permission::query()->get();

        $admin = Role::query()->where('name', RoleEnum::admin->name)->first();

        foreach ($allPermissions as $permission) {
            if (!$admin->permissions->contains('id', $permission->id)) {
                $admin->permissions()->attach($permission->id);
            }
        }

    }

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
