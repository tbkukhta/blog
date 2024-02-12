<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['controller' => \App\Http\Controllers\PostController::class], function () {
    Route::get('/', 'index')->name('home');
    Route::get('/post/{slug}', 'show')->name('post.show');
    Route::post('/post/{id}/comment', 'comment')->name('post.comment');
});

Route::get('/category/{slug}', [\App\Http\Controllers\CategoryController::class, 'show'])->name('category.show');
Route::get('/tag/{slug}', [\App\Http\Controllers\TagController::class, 'show'])->name('tag.show');
Route::get('/search', [\App\Http\Controllers\SearchController::class, 'index'])->name('search');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\MainController::class, 'index'])->name('index');
    Route::get('/search', [\App\Http\Controllers\Admin\SearchController::class, 'index'])->name('search');
    Route::resource('/categories', \App\Http\Controllers\Admin\CategoryController::class, ['parameters' => ['categories' => 'slug']]);
    Route::resource('/tags', \App\Http\Controllers\Admin\TagController::class, ['parameters' => ['tags' => 'slug']]);
    Route::resource('/posts', \App\Http\Controllers\Admin\PostController::class, ['parameters' => ['posts' => 'slug']]);
    Route::resource('/adverts', \App\Http\Controllers\Admin\AdvertController::class);
    Route::resource('/comments', \App\Http\Controllers\Admin\CommentController::class);
    Route::group(['controller' => UserController::class], function () {
        Route::get('/users', 'index')->name('users.index');
        Route::get('/users/add', 'add')->name('users.add');
        Route::post('/users/save', 'save')->name('users.save');
        Route::get('/users/{id}/edit', 'edit')->name('users.edit');
        Route::put('/users/{id}/update', 'update')->name('users.update');
        Route::delete('/users/{id}/destroy', 'destroy')->name('users.destroy');
    });
});

Route::group(['middleware' => 'guest', 'controller' => UserController::class], function () {
    Route::get('/register', 'create')->name('register.create');
    Route::post('/register', 'store')->name('register.store');
    Route::get('/login', 'loginForm')->name('login.create');
    Route::post('/login', 'login')->name('login');
});

Route::group(['middleware' => 'auth', 'controller' => UserController::class], function () {
    Route::post('/profile', 'profile')->name('profile');
    Route::post('/profile/{id}', 'update')->name('profile.update');
    Route::get('/logout', 'logout')->name('logout');
});

Route::fallback(function () {
    abort(404);
});
