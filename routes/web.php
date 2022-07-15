<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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

Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/register', [LoginController::class, 'prosreg'])->name( 'register_p');
Route::post('/login', [LoginController::class, 'proslog'])->name('login_p');
Route::get('/getProdi/{jid}', [LoginController::class, 'getProdi'])->name('getProdi');


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [AdminController::class, 'index'])->name('home');

    Route::get('getJurusan', [AdminController::class, 'getJurusan'])->name('getJurusan');
    Route::get('countApp/{idJurusan}', [AdminController::class, 'countApp'])->name('countApp');    

    Route::get('jurusan', [AdminController::class, 'list_jurusan'])->name('jurusan');
    Route::post('jurusan_add', [AdminController::class, 'add_jurusan'])->name('jurusan_add');
    Route::post('jurusan_edit/{id}', [AdminController::class, 'edit_jurusan']);
    Route::get('jurusan_destroy/{id}', [AdminController::class, 'delet_jurusan']);

    Route::get('prodi', [AdminController::class, 'list_prodi'])->name('prodi');
    Route::post('prodi_add', [AdminController::class, 'add_prodi'])->name('prodi_add');
    Route::post('prodi_edit/{id}', [AdminController::class, 'edit_prodi']);
    Route::get('prodi_destroy/{id}', [AdminController::class, 'delet_prodi']);

    Route::get('matkul', [AdminController::class, 'list_matkul'])->name('matkul');
    Route::post('matkul_add', [AdminController::class, 'add_matkul'])->name('matkul_add');
    Route::post('matkul_edit/{id}', [AdminController::class, 'edit_matkul']);
    Route::get('matkul_destroy/{id}', [AdminController::class, 'delet_matkul']);

    Route::get('listKRS', [AdminController::class, 'listKRS'])->name('listKRS');
    Route::get('actionKRS/{idKRS}/{status}', [AdminController::class, 'actionKRS'])->name('actionKRS');

    Route::post('importDataset', [AdminController::class, 'importDataset']);

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


    Route::get('/krs', [UserController::class, 'krs'])->name('krs');
    Route::post('/submitkrs', [UserController::class, 'submitKrs'])->name('submitkrs');

    Route::get('/profile', [LoginController::class, 'profile'])->name('profile');
    Route::post('/editProfile/{id}', [LoginController::class, 'editProfile'])->name('editProfile');
    Route::post('/changePass/{id}', [LoginController::class, 'changePass'])->name('changePass');
});
