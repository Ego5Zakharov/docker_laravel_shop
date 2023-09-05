<?php

namespace App\Http\Controllers\Auth\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request): Response|Application|ResponseFactory
    {
        $validated = $request->validated();


        if (User::query()->where('email', $validated['email'])->first()) {
            return \response()->json(['message' => 'User with this email already exists']);
        }

        $user = User::query()->create(
            [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password'])
            ],
        );
        $token = auth()->tokenById($user->id);

        return response(['access_token' => $token]);
    }
}
