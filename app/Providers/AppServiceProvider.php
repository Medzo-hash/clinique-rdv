<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        // Force le HTTPS en production (nécessaire derrière le proxy Railway,
        // sinon Laravel génère des URLs en http:// pour les assets Vite,
        // ce qui provoque des erreurs "Mixed Content" bloquées par le navigateur)
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}