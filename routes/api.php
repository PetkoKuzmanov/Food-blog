<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('comments',[CommentController::class, 'apiIndex'])->name('api.comments.index');

Route::post('comments',[CommentController::class, 'apiStore'])->name('api.comments.store');

Route::delete('comments',[CommentController::class, 'apiStore'])->name('api.comments.destroy');

