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

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/', [\App\Http\Controllers\Register::class, 'index'])->withoutMiddleware('link')->name('home');
Route::post('/register', [\App\Http\Controllers\Register::class, 'register'])->name('register');
Route::get('/login', [\App\Http\Controllers\Register::class, 'loginForm'])->name('loginForm');
Route::post('/login', [\App\Http\Controllers\Register::class, 'login'])->name('login');



Route::controller(\App\Http\Controllers\Game::class)->group(function () {
    Route::get('/game/{link?}', 'index')->middleware('link')->name('game');
    Route::post('/game/{link}/deactivate', 'deactivate')->middleware('link')->name('deactivate');
    Route::post('/game/{link}/generate', 'generateNewLink')->middleware('link')->name('generateNewLink');
    Route::post('/game/{link}/imfeelinglucky', 'imfeelinglucky')->middleware('link')->name('imfeelinglucky');
    Route::post('/game/{link}/history', 'history')->middleware('link')->name('history');
});
