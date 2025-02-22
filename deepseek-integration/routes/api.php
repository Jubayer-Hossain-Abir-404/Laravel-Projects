<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers\Api', 'prefix' => 'v1'], function () {
    Route::post('deepseek-chat', 'DeepseekController@chat');
});
