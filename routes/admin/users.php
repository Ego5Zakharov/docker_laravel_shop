<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::group([
        'namespace' => 'User',
        'middleware' => 'jwt.auth',
        'prefix' => 'users'
    ], function () {
        Route::post('/index', [UserController::class, 'index'])
            ->middleware('checkApiPermission:index users');

        Route::get('/{user}/show/', [UserController::class, 'show'])
            ->middleware('checkApiPermission:show users');

        Route::post('/getAllPermissionsWithoutRoles', [UserController::class, 'getAllPermissionsWithoutRoles'])
            ->middleware('getAllPermissionsWithoutRoles:getAllPermissionsWithoutRoles users');

        Route::post('/{user}/attachRolesToUser/', [UserController::class, 'attachRolesToUser'])
            ->middleware('checkApiPermission:attachRolesToUser users');

        Route::post('/{user}/attachPermissionToUser', [UserController::class, 'attachPermissionsToUser'])
            ->middleware('checkApiPermission:attachPermissionsToUser users');

        Route::delete('/{user}/{role}/detachRoleFromUser/', [UserController::class, 'detachRoleFromUser'])
            ->middleware('checkApiPermission:detachRoleFromUser users');

        Route::delete('/{user}/{permission}/detachPermissionFromUser', [UserController::class, 'detachPermissionFromUser'])
            ->middleware('checkApiPermission:detachPermissionFromUser users');
    });
});
