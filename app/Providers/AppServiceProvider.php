<?php

namespace App\Providers;

use App\Services\ProductService\ProductService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('productService', ProductService::class);
    }
    
    public function boot()
    {
        //
    }
}
