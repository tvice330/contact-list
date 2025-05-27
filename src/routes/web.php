<?php

use ContactList\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::prefix('contacts')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('contacts.index');
    Route::post('/', [ContactController::class, 'store'])->name('contacts.store');
    Route::delete('{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
});