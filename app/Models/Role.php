<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property Permission $permissions
 * @property User $users
 */
class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = ['name'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'user_roles',
            'role_id',
            'user_id');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            Permission::class,
            'role_permissions',
            'role_id',
            'permission_id'
        );
    }

    public function hasPermissionTo(string $permissionName): bool
    {
        return $this
            ->permissions()
            ->where('name', $permissionName)
            ->exists();
    }

}

