<?php

use App\Http\Controllers\ControllerUser;
use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [Dashboard::class, 'Dashboard'])->name('dasrboard');
Route::get('/view-login', [Dashboard::class, 'viewLogin'])->name('view-login');
Route::post('/auth-verification', [Dashboard::class, 'verification'])->name('auth-verification');
// use for error page
Route::view('/error', '404');
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
// use for admin
Route::get('/admin', [Dashboard::class, 'DashboardAdmin'])->name('admin');
Route::get('/gejala', [Dashboard::class, 'gejala'])->name('gejala');
Route::get('/gejala-add', [Dashboard::class, 'gejalaAdd'])->name('gejala-add');
Route::get('/gejala-edit/{id}', [Dashboard::class, 'gejalaEdit'])->name('gejala-edit');
Route::get('/penyakit', [Dashboard::class, 'penyakit'])->name('penyakit');
Route::get('/penyakit-add', [Dashboard::class, 'penyakitAdd'])->name('penyakit-add');
Route::get('/penyakit-edit/{id}', [Dashboard::class, 'penyakitEdit'])->name('penyakit-edit');
// pengetahuan
Route::get('/pengetahuan', [Dashboard::class, 'pengetahuan'])->name('pengetahuan');
Route::get('/pengetahuan-add', [Dashboard::class, 'pengetahuanAdd'])->name('pengetahuan-add');
Route::get('/pengetahuan-edit/{id}', [Dashboard::class, 'pengetahuanEdit'])->name('pengetahuan-edit');
// about
Route::get('/about', [Dashboard::class, 'about'])->name('about');
Route::get('/diagnosa', [ControllerUser::class, 'diagnosa'])->name('diagnosa');
Route::post('/make-diagnosa', [ControllerUser::class, 'makeDiagnosa'])->name('make-diagnosa');
