<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataAkademikController;
use App\Http\Controllers\InputDataController;

Route::get('/', [AuthController::class, 'loginForm']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('admin')->group(function () {

    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    );

    Route::get(
        '/data-akademik',
        [DataAkademikController::class, 'index']
    );

    Route::get(
        '/input-data',
        function () {
            return view('admin.input-data');
        }
    );

    Route::post(
        '/input-data/store',
        [InputDataController::class, 'store']
    );

    Route::post(
        '/input-data/import',
        [InputDataController::class, 'import']
    );

    Route::get(
        '/template-csv',
        [InputDataController::class, 'downloadTemplate']
    );

    Route::get(
        '/logout',
        [AuthController::class, 'logout']
    );
});
