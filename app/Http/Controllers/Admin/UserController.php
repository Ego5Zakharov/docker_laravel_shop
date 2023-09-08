<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\IndexUserRequest;
use App\Http\Resources\User\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
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
    public function create()
    {
        $this->authorize('create', User::class);
    }
}
