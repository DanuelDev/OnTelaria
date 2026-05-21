<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        if (config('app.env') === 'production' || app()->environment('production')) {
            URL::forceScheme('https');
        }
        
        Gate::define('acesso-funcionario', function (User $user) {
            return $user->role !== 'client';
        });
    }
}
