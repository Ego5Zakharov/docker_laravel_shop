<?php


namespace App\Traits;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

trait userAuthorizationHelper
{
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function getAllPermissions(): array
    {
        $permissions1 = $this->getAllPermissionsWithoutRoles()->pluck('name')->toArray();
        $permissions2 = $this->getAllPermissionsWithRoles();

        $permissions = [];

        foreach ($permissions1 as $permission) {
            $permissions[] = $permission;
        }

        foreach ($permissions2 as $permission) {
            if (is_array($permission)) {
                foreach ($permission as $subPermission) {
                    $permissions[] = $subPermission;
                }
            } else {
                $permissions[] = $permission;
            }
        }

        return $permissions;
    }


    public function getAllPermissionsWithRoles(): array
    {
        $userId = $this->id;

//        $cacheKey = "user_permissions_{$userId}";

//        return Cache::remember($cacheKey, now()->addDay(), function () use ($userId) {
        $permissions = [];

        foreach ($this->roles as $role) {
            $permissions[] = $role
                ->permissions
                ->pluck('name')
                ->toArray();
        }
        Log::info("Permissions for user {$userId} retrieved from cache");

        return $permissions;
//        });
    }

    public function getAllPermissionsWithoutRoles(): Collection
    {
        return $this
            ->permissions()
            ->get();
    }

    public function getAllRoles(): array
    {
        $userId = $this->id;

//        $cacheKey = "user_roles_{$userId}";

//        return Cache::remember($cacheKey, now()->addDay(), function () use ($userId) {
        Log::info("Roles for user {$userId} retrieved from cache");

        return $this
            ->roles()
            ->pluck('name')
            ->toArray();
//        });
    }

    public function hasPermissionTo(string $permissionName): bool
    {
        $userId = $this->id;
//        $cacheKey = "user_permissions_{$userId}";

//        $hasPermission = Cache::remember($cacheKey, now()->addHours(24), function () use ($permissionName, $userId) {
        foreach ($this->roles as $role) {
            if ($role->hasPermissionTo($permissionName)) {
                Log::info("Permissions for user {$userId} retrieved from cache");

                return true;
            }
        }
        return false;
//        });

        // костыль - если в кэше нет данных, то он создаст массив и возратит его
        // иначе он отдаст true, если в кеше уже есть данные
//        if (is_array($hasPermission)) {
//            return true;
//        }
//        return false;
    }
}
