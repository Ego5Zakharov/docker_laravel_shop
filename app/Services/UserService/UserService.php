<?php

namespace App\Services\UserService;

use App\Services\UserService\Actions\AttachPermissionsToUserAction;
use App\Services\UserService\Actions\AttachRolesToUserAction;
use App\Services\UserService\Actions\DetachPermissionFromUser;
use App\Services\UserService\Actions\DetachRoleFromUser;

class UserService
{
    public function attachPermissionsToUser(): AttachPermissionsToUserAction
    {
        return new AttachPermissionsToUserAction;
    }

    public function attachRolesToUser(): AttachRolesToUserAction
    {
        return new AttachRolesToUserAction;
    }

    public function detachRoleFromUser(): DetachRoleFromUser
    {
        return new DetachRoleFromUser;
    }

    public function detachPermissionFromUser(): DetachPermissionFromUser
    {
        return new DetachPermissionFromUser;
    }
}
