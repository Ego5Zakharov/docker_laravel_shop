<?php

namespace App\Services\UserService\Actions;

use App\Models\User;

trait userServiceHelper
{
    private array|null $rolesIds;

    private array|null $permissionsIds;

    private User $user;

    public function rolesIds(array $rolesIds): self
    {
        $this->rolesIds = $rolesIds;

        return $this;
    }

    public function user(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function permissionsIds(array $permissionsIds): self
    {
        $this->$permissionsIds = $permissionsIds;

        return $this;
    }

}
