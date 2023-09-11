<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{

    public const HOME = '/home';


    // protected $namespace = 'App\\Http\\Controllers';


    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(function () {
                    require_once base_path('routes/admin/api.php');
                    require_once base_path('routes/admin/products.php');
                    require_once base_path('routes/admin/tags.php');
                    require_once base_path('routes/admin/users.php');
                    require_once base_path('routes/admin/categories.php');
                    require_once base_path('routes/admin/permissions.php');
                    require_once base_path('routes/admin/roles.php');
                });

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
