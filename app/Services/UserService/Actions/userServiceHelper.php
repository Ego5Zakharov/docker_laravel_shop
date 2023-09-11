<?php

namespace App\Services\UserService\Actions;

use App\Models\User;

trait userServiceHelper
{
    private int|null $roleId;
    private array|null $rolesIds;

    private int|null $permissionId;
    private array|null $permissionsIds;

    private User|null $user;

    public function user(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function permissionId(int $permissionId): self
    {
        $this->permissionId = $permissionId;

        return $this;
    }

    public function permissionsIds(array $permissionsIds): self
    {
        $this->permissionsIds = $permissionsIds;

        return $this;
    }

    public function roleId(int $roleId): self
    {
        $this->roleId = $roleId;

        return $this;
    }

    public function rolesIds(array $rolesIds): self
    {
        $this->rolesIds = $rolesIds;

        return $this;
    }

}
