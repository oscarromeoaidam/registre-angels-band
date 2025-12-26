<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstrumentistController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', fn() => redirect()->route('instrumentists.index'));
Route::resource('instrumentists', InstrumentistController::class);
