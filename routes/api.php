<?php

use App\Http\Controllers\Api\AuthController;

use App\Http\Controllers\Api\BeneficiariesController;
use App\Http\Controllers\Api\PaymentsController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);

Route::post('pay', [\App\Http\Controllers\PaynowCOntroller::class, 'pay']);

Route::middleware('auth.api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::controller(PaymentsController::class)->group(function () {
        Route::get('payment-methods', 'paymentMethods');
        Route::get('payments', 'index');
        Route::post('payments', 'store');
    });
    Route::controller(BeneficiariesController::class)->group(function () {
        Route::get('/beneficiaries/{idNumber}', 'search');

    });
});
