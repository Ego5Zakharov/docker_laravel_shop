<?php

namespace App\Actions\Users;

class UserData
{
    public function __construct(
        public ?array $roles,
        public ?array $permissions,
    )
    {
    }
}
