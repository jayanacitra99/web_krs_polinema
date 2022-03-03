<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'proslog'])->name('login_p');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [AdminController::class, 'index'])->name('home');

    Route::get('jurusan', [AdminController::class, 'list_jurusan'])->name('jurusan');
    Route::post('jurusan_add', [AdminController::class, 'add_jurusan'])->name('jurusan_add');
    Route::post('jurusan_edit/{id}', [AdminController::class, 'edit_jurusan']);


    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});
