<?php

use App\Http\Controllers\SmsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/insert-batch', [SmsController::class, 'insertBatch']);
