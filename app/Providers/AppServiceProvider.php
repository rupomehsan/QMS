<?php

namespace App\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use App\Models\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

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

        class_alias(PersonalAccessToken::class, \Laravel\Sanctum\PersonalAccessToken::class);
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
