<?php

use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'v1', 'as' => 'api.', 'middleware' => 'throttle:api'], function () {
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');;
        Route::group(['controller' => \App\Http\Controllers\Api\V1\CategoryController::class], function () {
            Route::get('/categories', 'index')->name('categories.index');
            Route::get('/categories/{category}', 'show')->name('categories.show');
            Route::group(['middleware' => 'admin'], function () {
                Route::post('/categories', 'store')->name('categories.store');
                Route::put('/categories/{category}', 'update')->name('categories.update');
                Route::delete('/categories/{category}', 'destroy')->name('categories.destroy');
            });
        });
        Route::group(['controller' => \App\Http\Controllers\Api\V1\TagController::class], function () {
            Route::get('/tags', 'index')->name('tags.index');
            Route::get('/tags/{tag}', 'show')->name('tags.show');
            Route::group(['middleware' => 'admin'], function () {
                Route::post('/tags', 'store')->name('tags.store');
                Route::put('/tags/{tag}', 'update')->name('tags.update');
                Route::delete('/tags/{tag}', 'destroy')->name('tags.destroy');
            });
        });
        Route::group(['controller' => \App\Http\Controllers\Api\V1\PostController::class], function () {
            Route::get('/posts', 'index')->name('posts.index');
            Route::get('/posts/{post}', 'show')->name('posts.show');
            Route::group(['middleware' => 'admin'], function () {
                Route::post('/posts', 'store')->name('posts.store');
                Route::put('/posts/{post}', 'update')->name('posts.update');
                Route::delete('/posts/{post}', 'destroy')->name('posts.destroy');
            });
        });
    });
});
