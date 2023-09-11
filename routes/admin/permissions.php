<?php

use App\Http\Controllers\Admin\PermissionController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::group([
        'namespaced' => 'Permission',
        'middleware' => 'jwt.auth',
        'prefix' => 'permissions'
    ], function () {
        Route::post('/index', [PermissionController::class, 'index'])
            ->middleware('checkApiPermission:index permissions');

        Route::get('/{permission}/show', [PermissionController::class, 'show'])
            ->middleware('checkApiPermission:show permissions');

        Route::get('/getAllPermissionsWithId', [PermissionController::class, 'getAllPermissionsWithId'])
            ->middleware('checkApiPermission:getAllPermissionsWithId permissions');

        Route::post('/store', [PermissionController::class, 'store'])
            ->middleware('checkApiPermission:store permissions');

        Route::patch('/{permission}/update', [PermissionController::class, 'update'])
            ->middleware('checkApiPermission:update permissions');

        Route::delete('/{permission}/delete', [PermissionController::class, 'delete'])
            ->middleware('checkApiPermission:delete permissions');

    });
});
