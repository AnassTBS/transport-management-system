<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\FuelController;

Route::get('/', fn() => redirect()->route('dashboard'));
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('trucks',       TruckController::class);
Route::resource('drivers',      DriverController::class);
Route::resource('deliveries',   DeliveryController::class);
Route::resource('maintenances', MaintenanceController::class);
Route::resource('fuels',        FuelController::class);
