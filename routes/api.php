<?php

use App\Http\Controllers\Api\SbpIntegrationController;

// URL nantinya akan menjadi: http://127.0.0.1:8000/api/v1/siswa/{nisn}
Route::prefix('v1')->group(function () {
    Route::get('/siswa/{nisn}', [SbpIntegrationController::class, 'getStudentData']);
});
