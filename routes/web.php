<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PublicPortfolioController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/portfolio/edit', [PortfolioController::class, 'edit'])->name('portfolio.edit');
    Route::post('/portfolio/save', [PortfolioController::class, 'store'])->name('portfolio.save');
});

Route::get('/{slug}', PublicPortfolioController::class);

require __DIR__ . '/settings.php';
