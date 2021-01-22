<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\DiasTrabajoServiceInterface;
use App\Services\DiasTrabajoService;

class DiasTrabajoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DiasTrabajoServiceInterface::class, DiasTrabajoService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
