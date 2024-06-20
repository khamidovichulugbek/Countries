<?php

use App\Controllers\HomeController;
use App\Controllers\RegisterController;
use App\Controllers\AuthController;
use App\Kernel\Router\Route;
use App\Middlewares\AuthMiddlewares;

return [
    Route::get('/', [HomeController::class, 'index']),
    Route::get('/register', [RegisterController::class, 'index'], [AuthMiddlewares::class]),
    Route::post('/register', [RegisterController::class, 'register']),
    Route::get('/login', [AuthController::class, 'index'],[AuthMiddlewares::class]),
    Route::post('/login', [AuthController::class, 'login']),
    Route::post('/logout', [AuthController::class, 'logout']),
    Route::get('/profile', [AuthController::class, 'profile'], [GuestMiddlewares::class]),
    Route::post('/profile', [AuthController::class, 'update_profile']),
];
