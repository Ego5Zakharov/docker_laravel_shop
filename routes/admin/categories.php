<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
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
});
