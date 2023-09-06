<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;

class PermissionController extends Controller
{
    public function getPermissions(): JsonResponse
    {
        $authUserPermissions = auth()->user()->getAllPermissions();
        
        return response()->json(['permissions' => $authUserPermissions]);
    }
}
