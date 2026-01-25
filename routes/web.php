<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InstrumentistController;
use App\Http\Controllers\PartitionController;
use App\Http\Controllers\ExportController;

Route::get('/', fn () => redirect()->route('instrumentists.index'));

Auth::routes(['register' => false]);

// ==================== ROUTES ADMIN ====================
Route::middleware(['auth', 'admin'])->group(function () {
    // ---------- Instrumentistes ----------
    Route::get('/instrumentists/create', [InstrumentistController::class, 'create'])->name('instrumentists.create');
    Route::post('/instrumentists', [InstrumentistController::class, 'store'])->name('instrumentists.store');
    Route::get('/instrumentists/{instrumentist}/edit', [InstrumentistController::class, 'edit'])->name('instrumentists.edit');
    Route::put('/instrumentists/{instrumentist}', [InstrumentistController::class, 'update'])->name('instrumentists.update');
    Route::delete('/instrumentists/{instrumentist}', [InstrumentistController::class, 'destroy'])->name('instrumentists.destroy');
    
    // ---------- Partitions ----------
    Route::prefix('admin')->group(function () {
        // Création
        Route::get('/partitions/create', [PartitionController::class, 'create'])->name('partitions.create');
        Route::post('/partitions', [PartitionController::class, 'store'])->name('partitions.store');
        
        // Modification et suppression
        Route::get('/partitions/{partition}/edit', [PartitionController::class, 'edit'])->name('partitions.edit');
        Route::put('/partitions/{partition}', [PartitionController::class, 'update'])->name('partitions.update');
        Route::delete('/partitions/{partition}', [PartitionController::class, 'destroy'])->name('partitions.destroy');
    });
});

// ==================== ROUTES PUBLIQUES ====================

// ---------- Export ----------
Route::get('/instrumentists/export', [ExportController::class, 'exportInstrumentists'])
    ->name('instrumentists.export');

// ---------- Instrumentistes (lecture) ----------
Route::get('/instrumentists', [InstrumentistController::class, 'index'])->name('instrumentists.index');
Route::get('/instrumentists/{instrumentist}', [InstrumentistController::class, 'show'])->name('instrumentists.show');

// ---------- Partitions (lecture) ----------
Route::get('/partitions', [PartitionController::class, 'index'])->name('partitions.index');
Route::get('/partitions/{partition}/download', [PartitionController::class, 'download'])->name('partitions.download');