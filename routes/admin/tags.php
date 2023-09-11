<?php

use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
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
});
