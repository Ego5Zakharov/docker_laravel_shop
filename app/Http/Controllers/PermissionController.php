<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;

class PermissionController extends Controller
{
    // отправляет все полномочия пользователя связанные через роли
    public function getPermissions(): JsonResponse
    {
        $authUserPermissions = auth()->user()->getAllPermissions();

        return response()->json(['permissions' => $authUserPermissions]);
    }


}
