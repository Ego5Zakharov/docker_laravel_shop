<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\IndexRoleRequest;
use App\Http\Resources\Role\RoleResource;
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

//    /**
//     * @throws AuthorizationException
//     */
//    public function create()
//    {
//        $this->authorize('create', Role::class);
//    }

    /**
     * @throws AuthorizationException
     */
    public function store(CreateRoleRequest $request): RoleResource
    {
        $this->authorize('store', Role::class);

        $validatedData = $request->validated();

        $role = Role::query()->create([
            'name' => $validatedData['name']
        ]);

        if (isset($validatedData['permissions'])) {
            $role->permissions()->attach($validatedData['permissions']);
        }

        return RoleResource::make($role->refresh());
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
    public function update()
    {
        $this->authorize('update', Role::class);

    }

    /**
     * @throws AuthorizationException
     */
    public function delete(Role $role): JsonResponse
    {
        $this->authorize('delete', Role::class);

        $role->permissions()->detach();

        if ($role->delete()) {
            return response()->json(['message' => 'deleted'], 204);
        }

        return response()->json(['message' => 'Failed to delete product'], 500);
    }
}
