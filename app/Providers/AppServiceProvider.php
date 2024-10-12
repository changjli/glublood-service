<?php

namespace App\Providers;

use App\Repositories\DiabetesPredictionRepository;
use App\Repositories\DiabetesPredictionRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Services\DiabetesPredictionService;
use App\Services\DiabetesPredictionServiceInterface;
use App\Services\FoodLog\FoodLogService;
use App\Services\FoodLog\FoodLogServiceInterface;
use App\Services\MasterExercise\MasterExerciseService;
use App\Services\MasterExercise\MasterExerciseServiceInterface;
use App\Services\MasterFood\MasterFoodService;
use App\Services\MasterFood\MasterFoodServiceInterface;
use App\Services\GlucoseLog\GlucoseLogService;
use App\Services\GlucoseLog\GlucoseLogServiceInterface;
use App\Services\MedicineLog\MedicineLogService;
use App\Services\MedicineLog\MedicineLogServiceInterface;
use App\Services\OpenFoodFacts\OpenFoodFactsService as OpenFoodFactsOpenFoodFactsService;
use App\Services\OpenFoodFacts\OpenFoodFactsServiceInterface as OpenFoodFactsOpenFoodFactsServiceInterface;
use App\Services\OpenFoodFactsService;
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
        $this->app->bind(OpenFoodFactsOpenFoodFactsServiceInterface::class, OpenFoodFactsOpenFoodFactsService::class);
        $this->app->bind(FoodLogServiceInterface::class, FoodLogService::class);
        $this->app->bind(MasterExerciseServiceInterface::class, MasterExerciseService::class);
        $this->app->bind(MasterFoodServiceInterface::class, MasterFoodService::class);
        $this->app->bind(MedicineLogServiceInterface::class, MedicineLogService::class);
        $this->app->bind(GlucoseLogServiceInterface::class, GlucoseLogService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
