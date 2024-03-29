<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CountdownTimerController;
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

Route::get('/cart/add', [CartController::class, 'addItem'])->name('addItem');

Route::get('/cart/remove', [CartController::class, 'removeCartItem'])->name('removeCartItem');

Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('checkout');


//this is for login
Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::get('/register', [LoginController::class, 'registerPage'])->name('register');

Route::post('/register/submit', [LoginController::class, 'submitRegister'])->name('submitRegister');

Route::post('/login/submit', [LoginController::class, 'submitLogin'])->name('submitLogin');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::post('/profile/submit', [ProfileController::class, 'profileUpdate'])->name('submitProfile');


Route::get('/create-timer', [CountdownTimerController::class, 'create'])->name('timer.create');
Route::post('/update-timer', [CountdownTimerController::class, 'update'])->name('timer.update');
Route::get('/view-timer', [CountdownTimerController::class, 'view'])->name('timer.view');
