<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('dashboard');
// });
// Route::get('mahasiswa', function () {
//     return view('siswa');
// })->name('mahasiswa');

Route::get('/login', [AuthController::class, 'showlogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']); // <- ubah dari GET ke POST

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/mahasiswa', function () {
        return view('siswa');
    })->name('mahasiswa');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
