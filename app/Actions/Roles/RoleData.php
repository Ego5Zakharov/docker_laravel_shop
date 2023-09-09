<?php

namespace App\Actions\Roles;

class RoleData
{
    public function __construct(
        public ?string $name,
        public ?array  $permissions
    )
    {

    }
}
