<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Roles\CreateRoleAction;
use App\Actions\Roles\DeleteRoleAction;
use App\Actions\Roles\DetachPermissionFromRoleAction;
use App\Actions\Roles\RoleData;
use App\Actions\Roles\UpdateRoleAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\IndexRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Http\Resources\Role\RoleResource;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RoleController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(IndexRoleRequest $request): AnonymousResourceCollection
    {
        $this->authorize('index', Role::class);

        $validatedData = $request->validated();

        $perPage = 5;

        $roles = Role::query()->paginate($perPage, ['*'], 'page', $validatedData['page']);

        return RoleResource::collection($roles);
    }


    /**
     * @throws AuthorizationException
     */
    public function store(CreateRoleRequest $request): RoleResource
    {
        $this->authorize('store', Role::class);

        $validatedData = $request->validated();

        $roleData = new RoleData(
            name: $validatedData['name'],
            permissions: $validatedData['permissions'] ?? null
        );

        return RoleResource::make(
            (new CreateRoleAction)->run($roleData)
        );
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Role $role, UpdateRoleRequest $request): RoleResource
    {
        $this->authorize('update', Role::class);

        $validatedData = $request->validated();

        $roleData = new RoleData(
            name: $validatedData['name'],
            permissions: $validatedData['permissions'] ?? null,
        );

        return RoleResource::make(
            (new UpdateRoleAction)->run(data: $roleData, role: $role)
        );
    }

    /**
     * @throws AuthorizationException
     */
    public function show(Role $role): RoleResource
    {
        $this->authorize('show', Role::class);

        return RoleResource::make($role);
    }


    /**
     * @throws AuthorizationException
     */
    public function delete(Role $role): JsonResponse
    {
        $this->authorize('delete', Role::class);

        return (new DeleteRoleAction())->run($role) ?
            response()->json(['message' => 'deleted'], 204) :
            response()->json(['message' => 'Failed to delete role'], 500);
    }

    /**
     * @throws AuthorizationException
     */
    public function detachPermissionFromRole(Role $role, Permission $permission): JsonResponse
    {
        $this->authorize('detachPermissionFromRole', Role::class);

        return (new DetachPermissionFromRoleAction)->run($role, $permission)
            ? response()->json(['message' => 'Permission detached'], 204)
            : response()->json(['message' => 'Failed to detach permission'], 500);
    }
}
