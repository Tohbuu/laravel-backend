<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PortfolioController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes - explicitly defined
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Portfolio display
Route::get('/portfolio/{userId}', [PortfolioController::class, 'show'])->name('portfolio.show');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PortfolioController::class, 'dashboard'])->name('dashboard');
    Route::get('/portfolio/edit', [PortfolioController::class, 'edit'])->name('portfolio.edit');
    Route::put('/portfolio/update', [PortfolioController::class, 'update'])->name('portfolio.update');
    
    // You can add more authenticated routes here if needed
    // For example:
    // Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    // Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});