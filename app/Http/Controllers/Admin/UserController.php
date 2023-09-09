<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Users\UserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\EditUserRequest;
use App\Http\Requests\User\IndexUserRequest;
use App\Http\Resources\User\UserResource;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService\UserService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->$userService = $userService;
    }

    /**
     * @throws AuthorizationException
     */
    public function index(IndexUserRequest $request): AnonymousResourceCollection
    {
        $this->authorize('index', User::class);

        $validatedData = $request->validated();

        $perPage = 5;

        $users = User::query()->paginate($perPage, ['*'],
            pageName: 'page',
            page: $validatedData['page']);

        return UserResource::collection($users);
    }

    /**
     * @throws AuthorizationException
     */
    public function show(User $user): UserResource
    {
        $this->authorize('index', User::class);

        return UserResource::make($user);
    }

    /**
     * @throws AuthorizationException
     */
    public function attachRolesToUser(User $user, EditUserRequest $request): UserResource
    {
        $this->authorize('attachRolesToUser', User::class);

        $validatedData = $request->validated();

        $this->userService
            ->attachRolesToUser()
            ->user($user)
            ->rolesIds($validatedData['roles'])
            ->run();

        return UserResource::make($user);

    }

    /**
     * @throws AuthorizationException
     */
    public function attachPermissionsToUser(User $user, EditUserRequest $request): UserResource
    {
        $this->authorize('attachPermissionsToUser', User::class);

        $validatedData = $request->validated();

        $this->userService
            ->attachPermissionsToUser()
            ->user($user)
            ->permissionsIds($validatedData['permissions'])
            ->run();

        return UserResource::make($user);
    }

    public function detachPermissionFromUser(User $user, EditUserRequest $request): UserResource
    {
        $this->authorize('detachPermissionFromUser', User::class);

        $validatedData = $request->validated();

        $this->userService
            ->detachPermissionFromUser()
            ->user($user)
            ->permissionsIds($validatedData['permissions'])
            ->run();

        return UserResource::make($user);
    }

    public function detachRoleFromUser(User $user, EditUserRequest $request): UserResource
    {
        $this->authorize('detachRoleFromUser', User::class);

        $validatedData = $request->validated();

        $this->userService
            ->detachRoleFromUser()
            ->user($user)
            ->permissionsIds($validatedData['permissions'])
            ->run();

        return UserResource::make($user);
    }


    /**
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('update', User::class);
    }
}
