<?php

namespace App\Services\UserService\Actions;

class DetachRoleFromUser
{
    use userServiceHelper;

    public function run(): bool|int
    {
        if (!is_null($this->roleId) && !is_null($this->user)) {
            return $this->user->roles()->detach($this->roleId);
        }
        return false;
    }


}
