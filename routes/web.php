<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();
Route::get('/', function () {
    return view('auth.login');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/absen', [App\Http\Controllers\AbsenController::class, 'create'])->name('absen.create');
Route::post('/absen/store', [App\Http\Controllers\AbsenController::class, 'store'])->name('absen.store');
Route::get('/kelas/{jurusanId}', [App\Http\Controllers\AbsenController::class, 'getKelasByJurusan']);
Route::get('/siswa/{kelasId}', [App\Http\Controllers\AbsenController::class, 'getSiswaByKelas']);