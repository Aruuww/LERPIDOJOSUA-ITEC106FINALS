<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('login'));

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);
});

// Auth routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile',  [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/users',          [UserController::class, 'index'])->name('users.index');
    Route::post('/users',         [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}',   [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}',[UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/vehicles',             [VehicleController::class, 'index'])->name('vehicles.index');
    Route::post('/vehicles',            [VehicleController::class, 'store'])->name('vehicles.store');
    Route::put('/vehicles/{vehicle}',   [VehicleController::class, 'update'])->name('vehicles.update');
    Route::delete('/vehicles/{vehicle}',[VehicleController::class, 'destroy'])->name('vehicles.destroy');
});
