<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\RekapController;
use App\Http\Controllers\Admin\SiswaController;
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
Route::middleware(['auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/absen', [AbsenController::class, 'create'])->name('absen.create');
    Route::post('/absen/store', [AbsenController::class, 'store'])->name('absen.store');
    Route::get('/kelas/{jurusanId}', [AbsenController::class, 'getKelasByJurusan']);
    Route::get('/siswa/{kelasId}', [AbsenController::class, 'getSiswaByKelas']);
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/data/{kelasId}', [AdminController::class, 'getDataByKelas'])->name('admin.data');
});
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    //jurusan
    Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan.index');
    Route::get('/jurusan/create', [JurusanController::class, 'create'])->name('jurusan.create');
    Route::post('/jurusan/store', [JurusanController::class, 'store'])->name('jurusan.store');
    Route::get('/jurusan/{nama}', [JurusanController::class, 'show'])->name('jurusan.show');
    Route::get('/jurusan/{nama}/edit', [JurusanController::class, 'edit'])->name('jurusan.edit');
    Route::put('/jurusan/{nama}', [JurusanController::class, 'update'])->name('jurusan.update');
    Route::delete('/jurusan/{nama}', [JurusanController::class, 'destroy'])->name('jurusan.destroy');
    //kelas
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
    Route::get('/kelas/create', [KelasController::class, 'create'])->name('kelas.create');
    Route::post('/kelas/store', [KelasController::class, 'store'])->name('kelas.store');
    Route::get('/kelas/{nama}', [KelasController::class, 'show'])->name('kelas.show');
    Route::get('/kelas/{nama}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
    Route::put('/kelas/{nama}', [KelasController::class, 'update'])->name('kelas.update');
    Route::delete('/kelas/{nama}', [KelasController::class, 'destroy'])->name('kelas.destroy');
    //siswa
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('/siswa/store', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('/siswa/{nis}', [SiswaController::class, 'show'])->name('siswa.show');
    Route::get('/siswa/edit/{nis}', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::put('/siswa/{nis}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::delete('/siswa/{nis}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
    //rekap
    Route::get('/rekap', [RekapController::class, 'index'])->name('rekap.index');

});

