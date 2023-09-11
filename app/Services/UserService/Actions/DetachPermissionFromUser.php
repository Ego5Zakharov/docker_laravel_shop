<?php

namespace App\Services\UserService\Actions;

class DetachPermissionFromUser
{
    use userServiceHelper;

    public function run(): bool|int
    {
        if (!is_null($this->permissionId) && !is_null($this->user)) {
            return $this->user->permissions()->detach($this->permissionId);
        }

        return false;
    }
}
