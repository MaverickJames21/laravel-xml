<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\XMLReaderController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('users', UserController::class);
Route::resource('posts', PostController::class);
Route::resource('comments',CommentController::class);
Route::resource('billeds',BilletController::class);
Route::resource('appointments',AppointmentController::class);
Route::resource('Like',LikeController::class);
Route::get('convert-word-to-pdf', [DocumentController::class, 'convertWordToPDF']);
Route::get('read-xml',[XMLReaderController::class, 'readxml']);
Route::get('create-xml',[XMLReaderController::class, 'createXML']);
Route::get('/post-pdf', [PostController::class, 'index']);
