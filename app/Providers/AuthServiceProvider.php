<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        'App\Models\Category' => 'App\Policies\CategoryPolicy'
    ];


    public function boot()
    {
        $this->registerPolicies();
    }
}
