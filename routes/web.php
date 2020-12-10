<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;

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

Route::redirect('/', '/home/posts');

//Users
Route::get('home/users',[UserController::class, 'index'])->name('users.index');

Route::get('users/create',[UserController::class, 'create'])->name('users.create');

Route::post('users',[UserController::class, 'store'])->name('users.store');

Route::get('home/users/{id}',[UserController::class, 'show'])->name('users.show');


//Posts
Route::get('home/posts',[PostController::class, 'index'])->name('posts.index');

Route::get('posts/create',[PostController::class, 'create'])->name('posts.create');

Route::post('posts',[PostController::class, 'store'])->name('posts.store');

Route::get('home/posts/{id}',[PostController::class, 'show'])->name('posts.show');

//Tags

Route::get('home/tags',[TagController::class, 'index'])->name('tags.index');

Route::get('home/tags/{id}',[TagController::class, 'show'])->name('tags.show');


//Authentication
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');