<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Registration\EmailVerificationController;
use App\Http\Controllers\V1\Registration\RegistrationController;

use Illuminate\Support\Facades\Route;

Route::post('/email/verification', EmailVerificationController::class)->name('.email.verification');
Route::post('/account/register', RegistrationController::class)->name('.account.register');
