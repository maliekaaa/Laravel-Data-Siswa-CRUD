<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DataSiswaController::class, 'index'])->name('home');

Route::prefix('/data')->name('data.')->group(function() {
    Route::get('/dataSiswa', [DataController::class, 'index'])->name('dataSiswa');
    Route::get('/tambah-data', [DataController::class, 'create'])->name('tambah_data');
    Route::post('/tambah-data', [DataController::class, 'store'])->name('tambah_data.formulir');
    Route::delete('/hapus/{id}', [DataController::class, 'destroy'])->name('hapus');
    Route::get('/edit/{id}', [DataController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [DataController::class, 'update'])->name('edit.formulir');
});

Route::prefix('/akun')->name('akun.')->group(function() {
    Route::get('/data', [UserController::class, 'index'])->name('data');
    Route::get('/tambah', [UserController::class, 'create'])->name('tambah');
    Route::post('/tambah/akun', [UserController::class, 'store'])->name('tambah.akun');
    Route::delete('/hapus/{id}', [UserController::class, 'destroy'])->name('hapus');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [UserController::class, 'update'])->name('edit.formulir');
});


