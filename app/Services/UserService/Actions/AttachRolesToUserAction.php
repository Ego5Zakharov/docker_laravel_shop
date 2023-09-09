<?php

namespace App\Services\UserService\Actions;

class AttachRolesToUserAction
{
    use userServiceHelper;

    public function run(): void
    {
        if (!is_null($this->user) && !is_null($this->rolesIds)) {
            $this->user->roles()->attachWithoutSync($this->rolesIds);
        }
    }
}
