<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Permissions\CreatePermissionAction;
use App\Actions\Permissions\PermissionData;
use App\Actions\Permissions\UpdatePermissionAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\CreatePermissionRequest;
use App\Http\Requests\Permission\IndexPermissionRequest;
use App\Http\Requests\Permission\UpdatePermissionRequest;
use App\Http\Resources\Permission\PermissionResource;
use App\Models\Permission;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PermissionController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(IndexPermissionRequest $request): AnonymousResourceCollection
    {
        $this->authorize('index', Permission::class);

        $validatedData = $request->validated();

        $perPage = 5;

        $permissions = Permission::query()->paginate($perPage, ['*'], 'page', $validatedData['page']);

        return PermissionResource::collection($permissions);
    }

    /**
     * @throws AuthorizationException
     */
    public function show(Permission $permission): PermissionResource
    {
        $this->authorize('show', Permission::class);

        return PermissionResource::make($permission);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(CreatePermissionRequest $request): PermissionResource
    {
        $this->authorize('store', Permission::class);

        $validatedData = $request->validated();

        $permissionData = new PermissionData(
            name: $validatedData['name'],
            description: $validatedData['description'] ?? null
        );

        return PermissionResource::make(
            (new CreatePermissionAction)->run($permissionData)
        );
    }

    /**
     * @throws AuthorizationException
     */
    public function update(UpdatePermissionRequest $request, Permission $permission): PermissionResource
    {
        $this->authorize('update', Permission::class);

        $validatedData = $request->validated();

        $permissionData = new PermissionData(
            name: $validatedData['name'],
            description: $validatedData['description'] ?? null
        );

        return PermissionResource::make(
            (new UpdatePermissionAction)->run($permissionData, $permission)
        );
    }

    /**
     * @throws AuthorizationException
     */
    public function delete(Permission $permission): JsonResponse
    {
        $this->authorize('delete', Permission::class);

        if ($permission->delete()) {
            return response()->json(['message' => 'deleted'], 204);
        }

        return response()->json(['message' => 'Failed to delete product'], 500);
    }

    /**
     * @throws AuthorizationException
     */
    public function getAllPermissionsWithId(): AnonymousResourceCollection
    {
        $this->authorize('getAllPermissionsWithId', Permission::class);

        return PermissionResource::collection(
            Permission::query()->get()
        );
    }
}
