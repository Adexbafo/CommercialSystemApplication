<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate; // THIS MUST BE HERE
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Gate::define('admin', function (User $user) {
            return $user->id === 1; // Or use your email
        });
    }
}