<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/user', [UserController::class, 'index'])->middleware('auth:sanctum');

Route::post('/sanctum/token', [UserController::class, 'createToken']);