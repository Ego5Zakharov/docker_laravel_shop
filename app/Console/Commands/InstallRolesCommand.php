<?php

namespace App\Console\Commands;

use App\Enums\RoleEnum;
use App\Models\Role;
use Illuminate\Console\Command;

class InstallRolesCommand extends Command
{
    protected $signature = 'roles:install';

    public function handle(): void
    {
        $this->warn('Установка ролей');

        $this->installRoles();

        $this->warn('Роли установлены');
    }

    private function installRoles(): void
    {
        Role::query()
            ->firstOrCreate(['name' => RoleEnum::user->name])
            ->firstOrCreate(['name' => RoleEnum::admin->name])
            ->firstOrCreate(['name' => RoleEnum::moderator->name]);
    }


}
