<?php

use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\SupplyController;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['prefix' => 'employee'], function () {
    Route::post('/register', [AuthController::class, 'registerEmployeeDoctor']);
});

Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {

    // APPOINTMENTS API ROUTES
    Route::group(['prefix' => 'appointments'], function () {
        Route::get("/", [AppointmentsController::class, 'list'])
            ->name('appointments.list');

        Route::get("/{appointment}", [AppointmentsController::class, 'show'])
            ->name('appointments.show');

        Route::post("/{appointment}/change-status", [AppointmentsController::class, "changeStatus"])
            ->name('appointments.changeStatus');

        Route::post("/", [AppointmentsController::class, 'store'])
            ->name('appointments.store');
    });

    // DOCTORS API ROUTES
    Route::group(['prefix' => 'doctors'], function () {
        Route::get("/", [DoctorController::class, 'list'])
            ->name('doctors.list');
    });

    // SUPPLIES API ROUTES
    Route::group(
        ['prefix' => 'supply', 'middleware' => ['role:admin|medico']],
        function () {
            Route::get('/', [SupplyController::class, 'list'])
                ->name('supply.list');

            Route::post('/', [SupplyController::class, 'store'])
                ->name('supply.store');

            Route::get('/{supply}', [SupplyController::class, 'show'])
                ->name('supply.show');

            Route::post('/{supply}/edit', [SupplyController::class, 'update'])
                ->name('supply.update');
        }
    );

    // EXAMS API ROUTES
    Route::group(
        ['prefix' => 'exams', 'middleware' => ['role:admin|medico']],
        function () {
            Route::get('/', [DoctorController::class, 'list']);
        }
    );
});
