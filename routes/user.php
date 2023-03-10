<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\BlogController;
use App\Http\Controllers\User\BlogFavouriteController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\PlaceController;
use App\Http\Controllers\User\PlaceFavouriteController;
use App\Http\Controllers\User\ProfileController;

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
Route::get('/', [AuthController::class, 'auth'])->name('auth');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('signup', [AuthController::class, 'signUp'])->name('signup');

Route::middleware(['role:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::group([
        'prefix' => 'place',
        'as' => 'place.'
    ], function () {
        Route::get('', [PlaceController::class, 'index'])->name('index');
        Route::get('/create', [PlaceController::class, 'create'])->name('create');
        Route::post('/create', [PlaceController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PlaceController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [PlaceController::class, 'update'])->name('update');
        Route::get('my', [PlaceController::class, 'showMyPlaces'])->name('show_my_places');
        Route::get('/remove/{place}', [PlaceController::class, 'delete'])->name('remove');
        Route::post('/vote', [PlaceController::class, 'vote'])->name('vote');
    });
    Route::group([
        'prefix' => 'blog',
        'as' => 'blog.'
    ], function () {
        Route::post('create', [BlogController::class, 'store'])->name('store');
        Route::get('/remove/{blog}', [BlogController::class, 'delete'])->name('remove');
        Route::get('', [BlogController::class, 'index'])->name('index');
        Route::get('detail/{id}', [BlogController::class, 'show'])->name('detail');
        Route::post('detail/vote', [BlogController::class, 'vote'])->name('vote');
        Route::get('place/{id}', [BlogController::class, 'showByPlace'])->name('show_by_place');
        Route::get('my', [BlogController::class, 'showMyBlogs'])->name('show_my_blogs');
        Route::get('like', [BlogController::class, 'showLikeBlogs'])->name('show_like_blogs');
        Route::post('/favourite/delete/{id}', [BlogController::class, 'deleteBlogFavourite'])->name('delete');
    });

    Route::group([
        'prefix' => 'comment',
        'as' => 'comment.'
    ], function () {
        Route::post('create', [CommentController::class, 'store'])->name('store');
        Route::get('remove/{comment}', [CommentController::class, 'delete'])->name('delete');
    });

    Route::group([
        'prefix' => 'favourite',
        'as' => 'favourite.'
    ], function () {
        Route::get('like/{place}', [PlaceFavouriteController::class, 'like'])->name('like');
        Route::get('dislike/{place}', [PlaceFavouriteController::class, 'dislike'])->name('dislike');
        Route::get('like/blog/{blog}', [BlogFavouriteController::class, 'like'])->name('like_blog');
        Route::get('dislike/blog/{blog}', [BlogFavouriteController::class, 'dislike'])->name('dislike_blog');
    });

    Route::group([
        'prefix' => 'profile',
        'as' => 'profile.'
    ], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::post('/', [ProfileController::class, 'edit'])->name('edit');
        Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('changePassword');
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
