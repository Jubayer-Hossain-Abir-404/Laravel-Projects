<?php

use App\Http\Controllers\Posts\PostsController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/posts', [PostsController::class, 'index'])->name('posts');


// this is for insertion

// this one is for showing the content
Route::get('/posts/create', [PostsController::class, 'create'])->name('create');

// this will be used for storing the content
Route::post('/posts', [PostsController::class, 'store'])->name('insert');


//this is for update
Route::get('/posts/{post}/edit', [PostsController::class, 'edit'])->name('edit');

Route::put('/posts/{post}', [PostsController::class, 'update'])->name('update');


Route::delete('/posts/{post}', [PostsController::class, 'destroy'])->name('delete');