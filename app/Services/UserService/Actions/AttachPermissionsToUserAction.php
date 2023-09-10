<?php

namespace App\Services\UserService\Actions;

use App\Models\User;

class AttachPermissionsToUserAction
{
    use userServiceHelper;

    public function run(): bool
    {
        if (!is_null($this->permissionsIds)) {
            return (bool)$this->user->permissions()->syncWithoutDetaching($this->permissionsIds);
        }

        return false;
    }
}
