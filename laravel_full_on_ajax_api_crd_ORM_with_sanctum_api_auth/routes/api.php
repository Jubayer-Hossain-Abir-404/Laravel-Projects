<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/addAuthor', [AuthorController::class, 'store'])->name('addAuthor');

Route::post('/addCategory', [CategoryController::class, 'store'])->name('addCategory');

Route::post('/addPost', [PostController::class, 'store'])->name('addPost');

Route::get('/get_category_list', [CategoryController::class, 'getCategoryList'])->name('getCategoryList');



Route::post('/changeApprove', [PostController::class, 'changeApprove'])->name('changeApprove');


Route::get('/getPostEditData', [PostController::class, 'getPostEditData'])->name('getPostEditData');

Route::get('/getCategoryAuthor', [PostController::class, 'getCategoryAuthor'])->name('getCategoryAuthor');

Route::post('/updatePost', [PostController::class, 'updatePost'])->name('updatePost');

Route::get('/deletePost', [PostController::class, 'destroy'])->name('deletePost');

Route::get('/softDelete', [PostController::class, 'softDelete'])->name('softDelete');


Route::group(['middleware'=> ['auth:sanctum']], function () {
    Route::get('/get_post', [PostController::class, 'getPost'])->name('getPost');
    Route::get('/getBinPost', [PostController::class, 'getBinPost'])->name('getBinPost');
});

// soft delete

Route::post('/restorePost', [PostController::class, 'restorePost'])->name('restorePost');

Route::post('/restoreMultiplePost', [PostController::class, 'restoreMultiplePost'])->name('restoreMultiplePost');



// logiin

// Route::post('/login/submit', [RegisterController::class, 'submitLogin'])->name('submitLogin');