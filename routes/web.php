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


Route::redirect('/', '/home/posts')->middleware('auth');

//Users
Route::get('home/users',[UserController::class, 'index'])->name('users.index')->middleware('auth');

Route::get('home/users/chefs',[UserController::class, 'chefs'])->name('users.chefs')->middleware('auth');

Route::put('home/users/edit/{user}',[UserController::class, 'edit'])->name('users.edit')->middleware('auth');

Route::put('home/users/update/{user}',[UserController::class, 'update'])->name('users.update')->middleware('auth');

Route::get('home/users/{user}',[UserController::class, 'show'])->name('users.show')->middleware('auth');


//Posts
Route::get('home/posts',[PostController::class, 'index'])->name('posts.index')->middleware('auth');

Route::get('posts/create',[PostController::class, 'create'])->name('posts.create')->middleware('chef');

Route::post('posts',[PostController::class, 'store'])->name('posts.store')->middleware('chef');

Route::put('home/posts/edit/{post}',[PostController::class, 'edit'])->name('posts.edit')->middleware('auth');

Route::put('home/posts/update/{id}',[PostController::class, 'update'])->name('posts.update')->middleware('auth');

Route::get('home/posts/{post}',[PostController::class, 'show'])->name('posts.show')->middleware('auth');

Route::delete('home/posts/{post}',[PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');


//Tags
Route::get('home/tags',[TagController::class, 'index'])->name('tags.index')->middleware('auth');

Route::get('home/tags/{tag}',[TagController::class, 'show'])->name('tags.show')->middleware('auth');


//Authentication
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');