<?php

namespace App\Providers;

use App\Services\PetApiService;
use App\Services\PetApiServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PetApiServiceInterface::class, PetApiService::class);
    }

    public function boot(): void
    {
        //
    }
}
