<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;

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

Route::get('/', [IndexController::class, 'index'])->name('home');

Route::get('author', [AuthorController::class, 'index'])->name('author');

Route::get('post', [PostController::class, 'index'])->name('post');

Route::get('category', [CategoryController::class, 'index'])->name('category');


//this is for login
Route::get('/login', [RegisterController::class, 'loginPage'])->name('login');

Route::get('/register', [RegisterController::class, 'registerPage'])->name('register');

Route::post('/register/submit', [RegisterController::class, 'submitRegister'])->name('submitRegister');

Route::post('/login/submit', [RegisterController::class, 'submitLogin'])->name('submitLogin');
