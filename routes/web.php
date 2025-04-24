<?php

use App\Http\Controllers\KonsumenController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [KonsumenController::class, 'index'])->name('home');
