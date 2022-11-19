<?php

use App\Http\Controllers\File\FileController;
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

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [FileController::class, 'index'])->name('home');

Route::get('/create', [FileController::class, 'create'])->name('create');

Route::post('/store', [FileController::class, 'store'])->name('store');


Route::get('/edit/{id}', [FileController::class, 'edit'])->name('edit');


Route::post('update/{id}', [FileController::class, 'update'])->name('update');

Route::get('delete/{id}', [FileController::class, 'delete'])->name('delete');
