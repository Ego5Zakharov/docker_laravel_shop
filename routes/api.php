<?php

use App\Http\Controllers\Auth\Register\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Product\ProductController;

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
            Route::post('/index', [TagController::class, 'index']);
            Route::post('/', [TagController::class, 'store']);
            Route::get('/{tag}', [TagController::class, 'show']);
            Route::patch('/{tag}', [TagController::class, 'update']);
            Route::delete('/{tag}', [TagController::class, 'delete']);
        });

    Route::group([
        'namespace' => 'Category',
        'middleware' => 'jwt.auth',
        'prefix' => 'categories'],
        function () {
            Route::post('/index', [CategoryController::class, 'index'])->middleware('checkApiPermission:index categories');
            Route::post('/', [CategoryController::class, 'store'])->middleware('checkApiPermission:store categories');;
            Route::get('/{category}', [CategoryController::class, 'show'])->middleware('checkApiPermission:show categories');;
            Route::patch('/{category}', [CategoryController::class, 'update'])->middleware('checkApiPermission:update categories');;
            Route::delete('/{category}', [CategoryController::class, 'delete'])->middleware('checkApiPermission:delete categories');;
        });


    Route::group([
        'namespace' => 'Product',
        'middleware' => 'jwt.auth',
        'prefix' => 'products'],
        function () {
            Route::post('/index', [ProductController::class, 'index']);

            Route::get('/create', [ProductController::class, 'create']);

            Route::get('/{product}', [ProductController::class, 'show']);
            Route::post('/', [ProductController::class, 'store']);
            Route::post('/{product}/update', [ProductController::class, 'update']); // form-data в postman не работает с patch(не принимает картинки)
            Route::delete('/{product}', [ProductController::class, 'delete']);

            Route::delete('/{product}/{tag}/detachTag', [ProductController::class, 'detachTag']);
            Route::delete('/{product}/{image}/deleteProductImage', [ProductController::class, 'deleteProductImage']);
            Route::patch('/{product}/deleteProductPreviewImage', [ProductController::class, 'deleteProductPreviewImage']);
            Route::patch('/{product}/{image}/changeProductPreviewImage', [ProductController::class, 'changeProductPreviewImage']);
        });

});
