<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\PurchaseRequisitionController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'employee'])
    ->middleware(['auth', 'verified', 'role:employee'])->name('dashboard');

Route::get('/procurement-dashboard', [DashboardController::class, 'procurement'])
    ->middleware(['auth', 'verified', 'role:procurement'])->name('procurement-dashboard');

Route::get('/manager-dashboard', [DashboardController::class, 'manager'])
    ->middleware(['auth', 'verified', 'role:manager'])->name('manager-dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('requisitions', PurchaseRequisitionController::class);
    Route::patch('requisitions/{requisition}/approve', [PurchaseRequisitionController::class, 'approve'])->name('requisitions.approve');
    Route::patch('requisitions/{requisition}/reject', [PurchaseRequisitionController::class, 'reject'])->name('requisitions.reject');

    Route::middleware('role:procurement')->group(function () {
        Route::resource('products', ProductController::class)->except('show');
        Route::resource('suppliers', SupplierController::class)->except('show');
        Route::resource('purchase-orders', PurchaseOrderController::class)->only(['index', 'create', 'store', 'show']);
    });
});

require __DIR__.'/auth.php';
