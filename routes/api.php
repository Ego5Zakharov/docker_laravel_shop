<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\Register\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Admin\RoleController as AdminRoleController;
use App\Http\Controllers\Admin\PermissionController as AdminPermissionController;

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

    Route::get('/permissions/', [PermissionController::class, 'getPermissions']);
    Route::get('/roles/', [RoleController::class, 'getRoles']);

    Route::group([
        'namespace' => 'Tag',
        'middleware' => 'jwt.auth',
        'prefix' => 'tags'],
        function () {
            Route::post('/index', [TagController::class, 'index'])
                ->middleware('checkApiPermission:index tags');

            Route::post('/', [TagController::class, 'store'])
                ->middleware('checkApiPermission:store tags');

            Route::get('/{tag}', [TagController::class, 'show'])
                ->middleware('checkApiPermission:show tags');

            Route::patch('/{tag}', [TagController::class, 'update'])
                ->middleware('checkApiPermission:update tags');

            Route::delete('/{tag}', [TagController::class, 'delete'])
                ->middleware('checkApiPermission:delete tags');
        });

    Route::group([
        'namespace' => 'Category',
        'middleware' => 'jwt.auth',
        'prefix' => 'categories'],
        function () {
            Route::post('/index', [CategoryController::class, 'index'])
                ->middleware('checkApiPermission:index categories');

            Route::post('/', [CategoryController::class, 'store'])
                ->middleware('checkApiPermission:store categories');

            Route::get('/{category}', [CategoryController::class, 'show'])
                ->middleware('checkApiPermission:show categories');

            Route::patch('/{category}', [CategoryController::class, 'update'])
                ->middleware('checkApiPermission:update categories');

            Route::delete('/{category}', [CategoryController::class, 'delete'])
                ->middleware('checkApiPermission:delete categories');
        });


    Route::group([
        'namespace' => 'Product',
        'middleware' => 'jwt.auth',
        'prefix' => 'products'],
        function () {
            Route::post('/index', [ProductController::class, 'index'])
                ->middleware('checkApiPermission:index products');

            Route::get('/create', [ProductController::class, 'create'])
                ->middleware('checkApiPermission:create products');

            Route::get('/{product}', [ProductController::class, 'show'])
                ->middleware('checkApiPermission:show products');

            Route::post('/', [ProductController::class, 'store'])
                ->middleware('checkApiPermission:store products');

            Route::post('/{product}/update', [ProductController::class, 'update'])
                ->middleware('checkApiPermission:update products'); // form-data в postman не работает с patch(не принимает картинки)

            Route::delete('/{product}', [ProductController::class, 'delete'])
                ->middleware('checkApiPermission:delete products');

            Route::delete('/{product}/{tag}/detachTag', [ProductController::class, 'detachTag'])
                ->middleware('checkApiPermission:detachTag products');

            Route::delete('/{product}/{image}/deleteProductImage', [ProductController::class, 'deleteProductImage'])
                ->middleware('checkApiPermission:deleteProductImage products');

            Route::patch('/{product}/deleteProductPreviewImage', [ProductController::class, 'deleteProductPreviewImage'])
                ->middleware('checkApiPermission:deleteProductPreviewImage products');

            Route::patch('/{product}/{image}/changeProductPreviewImage', [ProductController::class, 'changeProductPreviewImage'])
                ->middleware('checkApiPermission:changeProductPreviewImage products');
        });

    Route::group([
        'namespace' => 'User',
        'middleware' => 'jwt.auth',
        'prefix' => 'users'
    ], function () {
        Route::post('/index', [UserController::class, 'index'])
            ->middleware('checkApiPermission:index users');

        Route::get('/{user}/show/', [UserController::class, 'show'])
            ->middleware('checkApiPermission:show users');

//        Route::get('/{user}/show/', [UserController::class, 'create'])
//            ->middleware('checkApiPermission:create users');
    });

    Route::group([
        'namespaced' => 'Role',
        'middleware' => 'jwt.auth',
        'prefix' => 'roles'
    ], function () {
        Route::post('/index', [AdminRoleController::class, 'index'])
            ->middleware('checkApiPermission:index roles');

        Route::get('/{role}/show', [AdminRoleController::class, 'show'])
            ->middleware('checkApiPermission:show roles');

        Route::post('/store', [AdminRoleController::class, 'store'])
            ->middleware('checkApiPermission:store roles');

        Route::post('/{role}/delete', [AdminRoleController::class, 'delete'])
            ->middleware('checkApiPermission:delete roles');
    });


    Route::group([
        'namespaced' => 'Permission',
        'middleware' => 'jwt.auth',
        'prefix' => 'permissions'
    ], function () {
        Route::post('/index', [AdminPermissionController::class, 'index'])
            ->middleware('checkApiPermission:index permissions');

        Route::get('/{permission}/show', [AdminPermissionController::class, 'show'])
            ->middleware('checkApiPermission:show permissions');

        Route::get('/getAllPermissionsWithId', [AdminPermissionController::class, 'getAllPermissionsWithId'])
            ->middleware('checkApiPermission:getAllPermissionsWithId permissions');

        Route::post('/store', [AdminPermissionController::class, 'store'])
            ->middleware('checkApiPermission:store permissions');

        Route::patch('/{permission}/update', [AdminPermissionController::class, 'update'])
            ->middleware('checkApiPermission:update permissions');

        Route::delete('/{permission}/delete', [AdminPermissionController::class, 'delete'])
            ->middleware('checkApiPermission:delete permissions');

    });
});
