<?php

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

Route::get('/', [App\Http\Controllers\SportsController::class, 'create'])->name('sports.create');
Route::post('/sports', [App\Http\Controllers\SportsController::class, 'store'])->name('sports.store');
Route::get('/sports', [App\Http\Controllers\SportsController::class, 'show'])->name('sports.show');
