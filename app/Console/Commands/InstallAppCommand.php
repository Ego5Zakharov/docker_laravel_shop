<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstallAppCommand extends Command
{
    protected $signature = 'app:install';

    protected $description = 'Install all application';

    public function handle()
    {
        $this->call(InstallRolesCommand::class);
        $this->call(InstallPermissionsCommand::class);

    }
}
