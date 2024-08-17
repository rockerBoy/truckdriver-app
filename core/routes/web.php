<?php

use App\Http\Controllers\Customers\CustomersController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', [CustomersController::class, 'index'])->name('home');
    Route::get('customers/{customer}/edit', [CustomersController::class, 'edit'])->name('customers.edit');
    Route::post('customers/{customer}', [CustomersController::class, 'update'])->name('customers.update');
});
