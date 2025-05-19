<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PortfolioController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

// Portfolio display
Route::get('/portfolio/{userId}', [PortfolioController::class, 'show'])->name('portfolio.show');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PortfolioController::class, 'dashboard'])->name('dashboard');
    Route::get('/portfolio/edit', [PortfolioController::class, 'edit'])->name('portfolio.edit');
    Route::put('/portfolio/update', [PortfolioController::class, 'update'])->name('portfolio.update');
});