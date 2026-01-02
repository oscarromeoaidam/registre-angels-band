<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InstrumentistController;

Route::get('/', fn () => redirect()->route('instrumentists.index'));

Auth::routes(['register' => false]);

// ✅ ADMIN uniquement (routes fixes d'abord)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/instrumentists/create', [InstrumentistController::class, 'create'])->name('instrumentists.create');
    Route::post('/instrumentists', [InstrumentistController::class, 'store'])->name('instrumentists.store');
    Route::get('/instrumentists/{instrumentist}/edit', [InstrumentistController::class, 'edit'])->name('instrumentists.edit');
    Route::put('/instrumentists/{instrumentist}', [InstrumentistController::class, 'update'])->name('instrumentists.update');
    Route::delete('/instrumentists/{instrumentist}', [InstrumentistController::class, 'destroy'])->name('instrumentists.destroy');
});

// ✅ PUBLIC (lecture seule)
Route::get('/instrumentists', [InstrumentistController::class, 'index'])->name('instrumentists.index');

// ⚠️ Toujours en dernier : route paramétrée
Route::get('/instrumentists/{instrumentist}', [InstrumentistController::class, 'show'])->name('instrumentists.show');
