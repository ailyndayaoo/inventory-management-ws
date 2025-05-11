<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;

Route::get('/', [InventoryController::class, 'index'])->name('inventory.index');
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
Route::post('/inventory/store', [InventoryController::class, 'store'])->name('inventory.store');
Route::delete('/inventory/{id}', [InventoryController::class, 'destroy'])->name('inventory.destroy');

// ✅ Edit and Update Routes
Route::get('/inventory/{id}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
Route::put('/inventory/{id}', [InventoryController::class, 'update'])->name('inventory.update');
