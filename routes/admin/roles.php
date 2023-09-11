<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::group([
        'namespaced' => 'Role',
        'middleware' => 'jwt.auth',
        'prefix' => 'roles'
    ], function () {
        Route::post('/index', [RoleController::class, 'index'])
            ->middleware('checkApiPermission:index roles');

        Route::get('/{role}/show', [RoleController::class, 'show'])
            ->middleware('checkApiPermission:show roles');

        Route::post('/store', [RoleController::class, 'store'])
            ->middleware('checkApiPermission:store roles');

        Route::patch('/{role}/update', [RoleController::class, 'update'])
            ->middleware('checkApiPermission:update roles');

        Route::delete('/{role}/delete', [RoleController::class, 'delete'])
            ->middleware('checkApiPermission:delete roles');

        Route::get('/getAllRolesWithId', [RoleController::class, 'getAllRolesWithId'])
            ->middleware('checkApiPermission:getAllRolesWithId roles');

        Route::delete('/{role}/{permission}/detachPermissionFromRole', [RoleController::class, 'detachPermissionFromRole'])
            ->middleware('checkApiPermission:detachPermissionFromRole roles');
    });
});
