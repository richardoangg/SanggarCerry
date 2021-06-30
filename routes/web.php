<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\AbsenSiswaController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\OrangtuaController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// pages
Route::get('/', [PagesController::class, 'getIndex']);

// auth
Route::get('/login', [AuthController::class, 'getLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'doLogin'])->middleware('guest');
Route::get('/logout', [AuthController::class, 'doLogout'])->middleware('auth');

// siswa
Route::resource('siswa', SiswaController::class)->except('show');

// jadwal
Route::resource('jadwal', JadwalController::class)->except('show');

// absen
Route::resource('absen', AbsenController::class)->except('edit', 'update');

// absen siswa
Route::resource('absen-siswa', AbsenSiswaController::class)->only('edit', 'update', 'destroy');

// pengumuman
Route::resource('pengumuman', PengumumanController::class);


// guru
Route::resource('guru', GuruController::class)->except('show')->middleware(['auth', 'role:admin']);
Route::group(['prefix' => 'guru', 'middleware' => ['auth', 'role:admin']], function() {
    Route::get('/{guru}/edit-password', [GuruController::class, 'editPassword'])->name('guru.edit-password');
    Route::put('/{guru}/update-password', [GuruController::class, 'updatePassword'])->name('guru.update-password');

});
// orangtua
Route::resource('orangtua', OrangtuaController::class)->except('show')->middleware(['auth', 'role:admin']);
Route::group(['prefix' => 'orangtua', 'middleware' => ['auth', 'role:admin']], function() {
    Route::get('/{orangtua}/edit-password', [OrangtuaController::class, 'editPassword'])->name('orangtua.edit-password');
    Route::put('/{orangtua}/update-password', [OrangtuaController::class, 'updatePassword'])->name('orangtua.update-password');});
