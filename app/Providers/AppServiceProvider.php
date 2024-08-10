<?php

namespace App\Providers;

use App\Repositories\DiabetesPredictionRepository;
use App\Repositories\DiabetesPredictionRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Services\DiabetesPredictionService;
use App\Services\DiabetesPredictionServiceInterface;
use App\Services\UserService;
use App\Services\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(DiabetesPredictionServiceInterface::class, DiabetesPredictionService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
