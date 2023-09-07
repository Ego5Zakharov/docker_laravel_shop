<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        'App\Models\Category' => 'App\Policies\CategoryPolicy',
        'App\Models\Tag' => 'App\Policies\TagPolicy',
        'App\Models\Product' => 'App\Policies\ProductPolicy'
    ];


    public function boot()
    {
        $this->registerPolicies();
    }
}
