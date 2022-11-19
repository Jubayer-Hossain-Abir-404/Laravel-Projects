<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserTable2\UserTable2Controller;

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

Route::get('/', [UserTable2Controller::class, 'index'])->name('home');

//to insert

Route::post('/user_table_2/create', [UserTable2Controller::class, 'store'])->name('insert');

//this is for update
Route::get('/user_table_2/{user_table}/edit', [UserTable2Controller::class, 'edit'])->name('edit');

Route::put('/user_table_2/{user_table}', [UserTable2Controller::class, 'update'])->name('update');

//for delete

Route::get('/user_table_2/{user_table}', [UserTable2Controller::class, 'destroy'])->name('delete');

