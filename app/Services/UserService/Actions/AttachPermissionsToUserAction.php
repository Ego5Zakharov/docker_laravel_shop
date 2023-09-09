<?php

namespace App\Services\UserService\Actions;

use App\Models\User;

class AttachPermissionsToUserAction
{
    use userServiceHelper;

    public function run(): bool
    {
        if (!is_null($this->permissions)) {
            return (bool)$this->user->permissions()->syncWithoutDetaching($this->permissions);
        }

        return false;
    }
}
