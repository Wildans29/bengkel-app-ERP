<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\EstimationController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\DashboardController;

Route::get('/test', function () {
    return response()->json(['status' => 'ok', 'time' => now()]);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('customers', CustomerController::class);
    Route::resource('items', ItemController::class);
    Route::resource('estimations', EstimationController::class);
    Route::get('/estimations/{id}/print', [EstimationController::class, 'print'])
    ->name('estimations.print');
    Route::resource('invoices', InvoiceController::class);
    Route::get('/invoices/{id}/print', [InvoiceController::class, 'print'])
    ->name('invoices.print');
    Route::get('estimations/{estimation}/invoice', [InvoiceController::class, 'createFromEstimation'])
        ->name('invoices.from-estimation');
    Route::resource('bills', BillController::class);
    Route::get('/bills/{id}/print', [BillController::class, 'print'])
    ->name('bills.print');
});

require __DIR__.'/auth.php';
