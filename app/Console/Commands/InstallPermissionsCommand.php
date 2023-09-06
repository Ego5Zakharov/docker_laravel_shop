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
        // categories
        Permission::query()
            ->firstOrCreate(['name' => 'index categories'])
            ->firstOrCreate(['name' => 'create categories'])
            ->firstOrCreate(['name' => 'update categories'])
            ->firstOrCreate(['name' => 'delete categories'])
            ->firstOrCreate(['name' => 'show categories']);
        // tags
        Permission::query()
            ->firstOrCreate(['name' => 'index tags'])
            ->firstOrCreate(['name' => 'create tags'])
            ->firstOrCreate(['name' => 'update tags'])
            ->firstOrCreate(['name' => 'delete tags']);

        $allPermissions = Permission::query()->get();

        $admin = Role::query()->where('name', RoleEnum::admin->name)->first();

        foreach ($allPermissions as $permission) {
            if (!$admin->permissions->contains('id', $permission->id)) {
                $admin->permissions()->attach($permission->id);
            }
        }

    }
}
