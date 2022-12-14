<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\IndexController;
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

Route::get('add_author', [AuthorController::class, 'add_author']);

Route::get('add_post/{id}', [PostController::class, 'add_post']);

Route::get('show_post/{id}', [PostController::class, 'show_post']);

Route::get('show_author/{id}', [AuthorController::class, 'show_author']);

Route::get('index/{id}', [IndexController::class, 'index']);

