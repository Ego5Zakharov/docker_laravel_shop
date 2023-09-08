<?php

namespace App\Actions\Permissions;

class PermissionData
{
    public function __construct(
        public ?string $name,
        public ?string $description
    )
    {

    }
}
