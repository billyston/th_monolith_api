<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Registration\EmailVerificationController;
use App\Http\Controllers\V1\Registration\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::post('/verification', EmailVerificationController::class)->name('.verification');
Route::post('/account', RegistrationController::class)->name('.account');
