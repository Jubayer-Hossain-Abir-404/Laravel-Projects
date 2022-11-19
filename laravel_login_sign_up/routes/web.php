<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Home\HomeController;
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
//     return view('welcome');
// });

// this is for home
Route::get('/', [HomeController::class, 'index'])->name('home');

//this is for registratation
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/registers', [RegisterController::class, 'store'])->name('new_register');


//this is for login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

// this is for logout
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

