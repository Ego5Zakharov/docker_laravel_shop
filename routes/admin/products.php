<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
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
});

