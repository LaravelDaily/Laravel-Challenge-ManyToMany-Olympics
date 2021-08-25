<?php

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

Auth::routes();

Route::get('/', [App\Http\Controllers\SportsController::class, 'create'])->name('create');
Route::post('/sports', [App\Http\Controllers\SportsController::class, 'store'])->name('store');
Route::get('/sports', [App\Http\Controllers\SportsController::class, 'show'])->name('show');
