<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

Route::get('/', [MahasiswaController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [MahasiswaController::class, 'adminIndex'])->name('index');
    
    Route::get('/create', [MahasiswaController::class, 'create'])->name('create');
    Route::post('/store', [MahasiswaController::class, 'store'])->name('store');
    Route::get('/{mahasiswa}/edit', [MahasiswaController::class, 'edit'])->name('edit');
    Route::put('/{mahasiswa}', [MahasiswaController::class, 'update'])->name('update');
    Route::delete('/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('destroy');
    Route::get('/{mahasiswa}', [MahasiswaController::class, 'show'])->name('show');
});