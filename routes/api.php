<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DailyCaloriesController;
use App\Http\Controllers\DiabetesPredictionController;
use App\Http\Controllers\ExerciseLogController;
use App\Http\Controllers\FoodLogController;
use App\Http\Controllers\MasterExerciseController;
use App\Http\Controllers\MasterFoodController;
use App\Http\Controllers\GlucoseLogController;
use App\Http\Controllers\MedicineLogController;
use App\Http\Controllers\UserProfileController;
use App\Http\Middleware\LoggingMiddleware;
use App\Models\MasterExercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('send-code', [AuthController::class, 'sendCode']);
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('change-password', [AuthController::class, 'changePassword']);
Route::post('refresh', [AuthController::class, 'refresh']);
Route::get('/test-error', function () {
    throw new \Exception('Test error');
});

Route::middleware('auth:api')->group(function () {
    Route::get('test', function () {
        return response()->json(['data' => 'hello world']);
    });

    Route::post('user-profile', [UserProfileController::class, 'store']);
    Route::get('user-profile', [UserProfileController::class, 'show']);
    Route::put('user-profile', [UserProfileController::class, 'update']);

    Route::get('diabetes-prediction', [DiabetesPredictionController::class, 'index']);
    Route::post('diabetes-prediction', [DiabetesPredictionController::class, 'store']);
    Route::get('diabetes-prediction/predict', [DiabetesPredictionController::class, 'predict']);
    Route::get('diabetes-prediction/{diabetesPrediction}', [DiabetesPredictionController::class, 'show']);

    Route::get('master-foods', [MasterFoodController::class, 'search']);
    Route::get('master-foods/{id}', [MasterFoodController::class, 'show']);

    Route::get('food/barcode', [FoodLogController::class, 'getByBarcode']);
    Route::get('food/search', [FoodLogController::class, 'search']);

    Route::get('food', [FoodLogController::class, 'index']);
    Route::post('food', [FoodLogController::class, 'store']);
    Route::get('food/{foodLog}', [FoodLogController::class, 'show']);
    Route::put('food/{foodLog}', [FoodLogController::class, 'update']);
    Route::delete('food/{foodLog}', [FoodLogController::class, 'destroy']);

    Route::get('exercise/search', [MasterExerciseController::class, 'search']);

    Route::prefix('logs')->group(function () {
        Route::get('exercise', [ExerciseLogController::class, 'index']);
        Route::post('exercise', [ExerciseLogController::class, 'store']);
        Route::get('exercise/{exerciseLog}', [ExerciseLogController::class, 'show']);
        Route::put('exercise/{id}', [ExerciseLogController::class, 'update']);
        Route::delete('exercise/{exerciseLog}', [ExerciseLogController::class, 'destroy']);
    });

    Route::prefix('master')->group(function () {
        Route::get('/exercises', [MasterExerciseController::class, 'index']);
    });

    Route::get('daily-calories', [DailyCaloriesController::class, 'index']);
    Route::post('daily-calories', [DailyCaloriesController::class, 'store']);

    Route::post('medicine', [MedicineLogController::class, 'store']);
    Route::get('medicine/{medicineLog}', [MedicineLogController::class, 'show']);
    Route::put('medicine/{medicineLog}', [MedicineLogController::class, 'update']);
    Route::delete('medicine/{medicineLog}', [MedicineLogController::class, 'destroy']);

    Route::post('glucose', [GlucoseLogController::class, 'store']);
    Route::get('glucose/{glucoseLog}', [GlucoseLogController::class, 'show']);
    Route::put('glucose/{glucoseLog}', [GlucoseLogController::class, 'update']);
    Route::delete('glucose/{glucoseLog}', [GlucoseLogController::class, 'destroy']);
});
