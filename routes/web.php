<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::get('/dashboard', function () {
    return view('welcome');
});

// Route::get('post/comment/{post}',[PostController::class,'comment']);
Route::post('post/comment/{comment}',[PostController::class,'createComment'])->name('comment.store');
Route::post('post/comment/edit/{comment}', [PostController::class, 'editComment'])->name('comment.edit');
Route::delete('post/comment/delete/{comment}', [PostController::class, 'deleteComment'])->name('comment.delete');


Route::resource('blog', PostController::class);
Route::get('/trashed',[PostController::class, 'softDelete'])->name('post.soft.delete');
Route::post('/restore/{post}',[PostController::class, 'restore'])->name('post.restore');
Route::delete('/force/delete/{post}',[PostController::class, 'forceDelete'])->name('post.forceDelete');
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');