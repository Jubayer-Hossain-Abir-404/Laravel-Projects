<?php

use App\Http\Controllers\UserTable\UserTableController;
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
//     return view('home.index');
// });

Route::get('/', [UserTableController::class, 'index'])->name('home');

//this is for update
Route::get('/user_table/{user_table}/edit', [UserTableController::class, 'edit'])->name('edit');

Route::put('/user_table/{user_table}', [UserTableController::class, 'update'])->name('update');


// this is for creation

// Route::get('/user_tables/create', [PostsController::class, 'create'])->name('create');

// this will be used for storing the content
Route::post('/user_table', [UserTableController::class, 'store'])->name('insert');

//delete
Route::get('/user_table/{user_table}/delete', [UserTableController::class, 'delete'])->name('delete');

Route::delete('/user_table/{user_table}', [UserTableController::class, 'destroy'])->name('destroy');

