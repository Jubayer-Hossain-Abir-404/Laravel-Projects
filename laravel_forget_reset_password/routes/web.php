<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ForgotPasswordController;
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


Route::middleware(['auth'])->group(function () {
    Route::get('author', [AuthorController::class, 'index'])->name('author');

    Route::get('post', [PostController::class, 'index'])->name('post');

    Route::get('category', [CategoryController::class, 'index'])->name('category');

    Route::get('/logout', [RegisterController::class, 'logout'])->name('logout');
});

Route::get('/', [IndexController::class, 'index'])->name('home');

//this is for login

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [RegisterController::class, 'loginPage'])->name('login');

    Route::get('/register', [RegisterController::class, 'registerPage'])->name('register');

    Route::post('/register/submit', [RegisterController::class, 'submitRegister'])->name('submitRegister');

    Route::post('/login/submit', [RegisterController::class, 'submitLogin'])->name('submitLogin');
});


Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
