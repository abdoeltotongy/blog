<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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
    return view('auth.login');
});


Route::group(['middleware'=>'auth'] , function (){


Route::resource('comment', CommentController::class);
Route::resource('blog', PostController::class);

Route::get('posts/trashed',[PostController::class, 'deletedPosts'])->name('post.soft.delete');
Route::post('posts/restore/{post}',[PostController::class, 'restore'])->name('post.restore');
Route::delete('posts/forceDelete/{post}',[PostController::class, 'forceDelete'])->name('post.forceDelete');

});
Auth::routes();

// Route::get('/blog', [PostController::class, 'index'])->name('home');
