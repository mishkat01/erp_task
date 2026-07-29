<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:employee'])->name('dashboard');

Route::get('/procurement-dashboard', function () {
    return view('procurement-dashboard');
})->middleware(['auth', 'verified', 'role:procurement'])->name('procurement-dashboard');

Route::get('/manager-dashboard', function () {
    return view('manager-dashboard');
})->middleware(['auth', 'verified', 'role:manager'])->name('manager-dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
