<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RolesController;
use App\Http\Controllers\Backend\UsersController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//admin routes
Route::group(['prefix' => 'admin'], function () {
   Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
   Route::resource('roles', RolesController::class, ['names' => 'admin.roles']);
   Route::resource('users', UsersController::class, ['names' => 'admin.users']);

   // Login Routes
   Route::get('/login',[LoginController::class, 'showLoginForm'])->name('admin.login');
   Route::post('/login/submit',[LoginController::class, 'login'])->name('admin.login.submit');

   // Logout Routes
   Route::post('/logout/submit',[LoginController::class, 'logout'])->name('admin.logout.submit');

   // Forget Password Routes
   Route::get('/password/reset',[ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
   Route::post('/password/reset/submit',[ForgotPasswordController::class, 'reset'])->name('admin.password.update');
});
