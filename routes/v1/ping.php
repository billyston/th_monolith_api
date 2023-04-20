<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Ping\PingController;
use Illuminate\Support\Facades\Route;

Route::get(
    '/',
    PingController::class,
)->name('ping');
