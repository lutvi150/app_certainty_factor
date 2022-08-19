<?php

use App\Http\Controllers\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/gejalaStore', [Dashboard::class, 'gejalaStore'])->name('api-gejalaStore');
Route::post('/gejalaDelete', [Dashboard::class, 'gejalaDelete'])->name('api-gejalaDelete');
Route::post('/gejalaUpdate', [Dashboard::class, 'gejalaUpdate'])->name('api-gejalaUpdate');
Route::post('/penyakitStore', [Dashboard::class, 'penyakitStore'])->name('api-penyakitStore');
Route::post('/penyakitDelete', [Dashboard::class, 'penyakitDelete'])->name('api-penyakitDelete');
Route::post('/penyakitUpdate', [Dashboard::class, 'penyakitUpdate'])->name('api-penyakitUpdate');
// pengetahuan
Route::post('/pengetahuanStore', [Dashboard::class, 'pengetahuanStore'])->name('api-pengetahuanStore');
Route::post('/pengetahuanDelete', [Dashboard::class, 'pengetahuanDelete'])->name('api-pengetahuanDelete');
Route::post('/pengetahuanUpdate', [Dashboard::class, 'pengetahuanUpdate'])->name('api-pengetahuanUpdate');
