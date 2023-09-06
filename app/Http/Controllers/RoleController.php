<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class RoleController extends Controller
{
    public function getRoles(): JsonResponse
    {
        $authUserRoles = auth()->user()->getAllRoles();

        return response()->json(['roles' => $authUserRoles]);
    }
}
