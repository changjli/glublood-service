<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DailyCaloriesController;
use App\Http\Controllers\DiabetesPredictionController;
use App\Http\Controllers\ExerciseLogController;
use App\Http\Controllers\FoodLogController;
use App\Http\Controllers\FoodMenuController;
use App\Http\Controllers\MasterExerciseController;
use App\Http\Controllers\MasterFoodController;
use App\Http\Controllers\GlucoseLogController;
use App\Http\Controllers\LogReportController;
use App\Http\Controllers\MedicineLogController;
use App\Http\Controllers\SavedMenuController;
use App\Http\Controllers\UserProfileController;
use App\Http\Middleware\LoggingMiddleware;
use App\Models\MasterExercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('send-code', [AuthController::class, 'sendCode']);
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('refresh', [AuthController::class, 'refresh']);
Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('verify-password', [AuthController::class, 'verifyForgotPassword']);
Route::post('reset-password', [AuthController::class, 'resetPassword']);
Route::get('/test-error', function () {
    throw new \Exception('Test error');
});

Route::middleware('auth:api')->group(function () {
    Route::get('test', function () {
        return response()->json(['data' => 'hello world']);
    });

    Route::post('change-password', [AuthController::class, 'changePassword']);

    Route::post('user-profile', [UserProfileController::class, 'store']);
    Route::get('user-profile', [UserProfileController::class, 'show']);
    Route::put('user-profile', [UserProfileController::class, 'update']);
    Route::put('user-profile/image', [UserProfileController::class, 'saveProfileImage']);
    Route::delete('user-profile/image', [UserProfileController::class, 'deleteProfileImage']);

    Route::get('diabetes-prediction', [DiabetesPredictionController::class, 'index']);
    Route::post('diabetes-prediction', [DiabetesPredictionController::class, 'store']);
    Route::post('diabetes-prediction/predict', [DiabetesPredictionController::class, 'predictV2']);
    Route::get('diabetes-prediction/{diabetesPrediction}', [DiabetesPredictionController::class, 'show']);

    Route::get('master-foods', [MasterFoodController::class, 'search']);
    Route::get('master-foods/{id}', [MasterFoodController::class, 'show']);

    Route::post('food/barcode', [FoodLogController::class, 'getByBarcode']);
    Route::get('food/search', [FoodLogController::class, 'search']);

    Route::get('food', [FoodLogController::class, 'index']);
    Route::post('food', [FoodLogController::class, 'store']);
    Route::post('food/report/date', [FoodLogController::class, 'getFoodLogReportByDate']);
    Route::post('food/report/month', [FoodLogController::class, 'getFoodLogReportByMonth']);
    Route::post('food/report/year', [FoodLogController::class, 'getFoodLogReportByYear']);
    Route::get('food/{foodLog}', [FoodLogController::class, 'show']);
    Route::put('food/{foodLog}', [FoodLogController::class, 'update']);
    Route::delete('food/{foodLog}', [FoodLogController::class, 'destroy']);

    Route::get('exercise/search', [MasterExerciseController::class, 'search']);

    Route::prefix('logs')->group(function () {
        Route::prefix('exercise')->group(function () {
            Route::get('', [ExerciseLogController::class, 'index']);
            Route::post('', [ExerciseLogController::class, 'store']);
            Route::post('report/date', [ExerciseLogController::class, 'getExerciseLogReportByDate']);
            Route::post('report/month', [ExerciseLogController::class, 'getExerciseLogReportByMonth']);
            Route::post('report/year', [ExerciseLogController::class, 'getExerciseLogReportByYear']);
            Route::get('{exerciseLog}', [ExerciseLogController::class, 'show']);
            Route::put('{id}', [ExerciseLogController::class, 'update']);
            Route::delete('{exerciseLog}', [ExerciseLogController::class, 'destroy']);
        });
    });

    Route::prefix('master')->group(function () {
        Route::get('/exercises', [MasterExerciseController::class, 'index']);
    });

    Route::get('daily-calories', [DailyCaloriesController::class, 'index']);
    Route::post('daily-calories', [DailyCaloriesController::class, 'store']);
    Route::get('daily-calories/burned', [DailyCaloriesController::class, 'getDailyCaloriesBurned']);

    Route::get('medicine', [MedicineLogController::class, 'index']);
    Route::post('medicine', [MedicineLogController::class, 'store']);
    Route::get('medicine/{medicineLog}', [MedicineLogController::class, 'show']);
    Route::put('medicine/{medicineLog}', [MedicineLogController::class, 'update']);
    Route::delete('medicine/{medicineLog}', [MedicineLogController::class, 'destroy']);

    Route::get('glucose', [GlucoseLogController::class, 'index']);
    Route::post('glucose', [GlucoseLogController::class, 'store']);
    Route::post('glucose/batch', [GlucoseLogController::class, 'storeGlucoseLogBatch']);
    Route::get('glucose/sync', [GlucoseLogController::class, 'syncGlucoseLog']);
    Route::get('glucose/{glucoseLog}', [GlucoseLogController::class, 'show']);
    Route::put('glucose/{glucoseLog}', [GlucoseLogController::class, 'update']);
    Route::delete('glucose/{glucoseLog}', [GlucoseLogController::class, 'destroy']);
    Route::post('glucose/report/date', [GlucoseLogController::class, 'getGlucoseLogReportByDate']);
    Route::post('glucose/report/month', [GlucoseLogController::class, 'getGlucoseLogReportByMonth']);
    Route::post('glucose/report/year', [GlucoseLogController::class, 'getGlucoseLogReportByYear']);

    Route::post('report', [LogReportController::class, 'getAllLogReportByDateV2']);

    Route::get('food-menus', [FoodMenuController::class, 'index']);
    Route::post('food-menus/save', [SavedMenuController::class, 'save']);
    Route::get('food-menus/save', [SavedMenuController::class, 'index']);
    Route::get('food-menus/{id}', [FoodMenuController::class, 'show']);
});
