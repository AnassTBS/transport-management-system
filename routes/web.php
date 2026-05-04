<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\FuelController;

use App\Http\Controllers\AuthController;

Route::get('/', fn() => redirect()->route('dashboard'));

// Routes d'authentification
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes protégées
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('trucks',       TruckController::class);
    Route::resource('drivers',      DriverController::class);
    Route::resource('deliveries',   DeliveryController::class);
    Route::resource('maintenances', MaintenanceController::class);
    Route::resource('fuels',        FuelController::class);
});
