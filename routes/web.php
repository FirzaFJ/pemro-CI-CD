<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TugasController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'register']);

// Route::resource('/tugas', TugasController::class);

Route::get('/tugas', [TugasController::class, 'index'])->middleware('auth');
Route::post('/tugas', [TugasController::class, 'store'])->middleware('auth');
Route::get('/tugas/{tugas:id}/view', [TugasController::class, 'show'])->middleware('auth');
Route::post('/tugas/{tugas:id}/selesai', [TugasController::class, 'selesai'])->middleware('auth');
Route::get('/tugas/{tugas:id}/edit', [TugasController::class, 'edit'])->middleware('auth');
Route::post('/tugas/{tugas:id}', [TugasController::class, 'update'])->middleware('auth');
Route::post('/tugas/{tugas:id}/delete', [TugasController::class, 'destroy'])->middleware('auth');
