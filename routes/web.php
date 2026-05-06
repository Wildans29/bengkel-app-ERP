<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\EstimationController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\DashboardController;

// Route::get('/test', function () {
//     return response()->json(['status' => 'ok', 'time' => now()]);
// });

Route::get('/', function () {
    return redirect('/login');
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

// Temporary seed route - HAPUS setelah selesai!
Route::get('/seed-demo/{key}', function ($key) {
    if ($key !== 'bengkel123') {
        abort(403);
    }
    \Illuminate\Support\Facades\Artisan::call('db:seed --class=Database\\Seeders\\DemoSeeder');
    return 'Seeding done! 10 customers + 15 items + transactions created.';
});

require __DIR__.'/auth.php';
