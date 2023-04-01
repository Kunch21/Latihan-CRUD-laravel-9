<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\BlogController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [BlogController::class, 'index']);

Route::get('/post', [BlogController::class, 'create'])->name('posts');

Route::post('/store', [BlogController::class, 'store'])->name('tambah.post');

Route::resource('/post', \App\Http\Controllers\ShowController::class);

Route::get('/edit/{id}', [BlogController::class, 'edit']);

Route::post('/update/{id}', [BlogController::class, 'update']);

Route::get('/delete/{id}', [BlogController::class, 'destroy']);
