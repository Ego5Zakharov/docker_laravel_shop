<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    public function handle(Request $request, Closure $next, string $permission)
    {
        if (!auth()->user()->hasPermissionTo($permission)) {
            return response()->json(['message' => 'Access denied'], 403);
        }
        return $next($request);
    }
}
