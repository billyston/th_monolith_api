<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

// Ping Route
Route::prefix('ping')->as('ping:')->group(base_path('routes/v1/ping/ping.php'));

// registration
Route::prefix('registration')->as('registration')->group(base_path('routes/v1/registration/registration.php'));
