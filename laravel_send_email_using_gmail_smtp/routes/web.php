<?php

use App\Mail\MyMail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

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

Route::get('send-mail', function () {

    $details = [
        'title' => 'Mail from Codersvibe.com',
        'body' => 'This is my first mail using Gmail SMTP'
    ];

    Mail::to('mjh.jubayerhossain@gmail.com')->send(new MyMail);

    dd("Email is Sent.");
});
