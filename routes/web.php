<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;

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


//   frontend
Route::get('/', [PostController::class, 'index'])->name('main');
Route::get('/posts', [PostController::class, 'posts'])->name('posts');



//   backend
Route::group([
    'middleware' => 'admin',
    'prefix' => 'admin'],function () {

    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

//    post
    Route::get('/posts', [AdminController::class, 'posts'])->name('table-posts');
    Route::get('/get-posts', [AdminController::class, 'getPosts'])->name('get-posts');
    Route::post('/store-post', [AdminController::class, 'postStore'])->name('post.store');
    Route::post('delete-post',[AdminController::class, 'postDelete'])->name('post.delete');

//    item
    Route::get('/items', [AdminController::class, 'items'])->name('table-items');
    Route::get('/get-items', [AdminController::class, 'getItems'])->name('get-items');
    Route::post('/store-item', [AdminController::class, 'itemStore'])->name('item.store');
    Route::post('delete-item',[AdminController::class, 'itemDelete'])->name('item.delete');

//   topic
    Route::get('/topics', [AdminController::class, 'topics'])->name('table-topics');
    Route::get('/get-topics', [AdminController::class, 'getTopics'])->name('get-topics');
    Route::post('/store-topic', [AdminController::class, 'topicStore'])->name('topic.store');
    Route::post('delete-topic',[AdminController::class, 'topicDelete'])->name('topic.delete');

//   users
    Route::get('/users', [AdminController::class, 'users'])->name('table-users');
    Route::get('/get-users', [AdminController::class, 'getUsers'])->name('get-users');
    Route::post('/store-user', [AdminController::class, 'userStore'])->name('user.store');
    Route::post('delete-user',[AdminController::class, 'userDelete'])->name('user.delete');

});

Auth::routes();

