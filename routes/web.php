<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RestoListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ContentController::class, 'home']);

Route::group(['middleware' => 'isAdmin'], function () {
    Route::get('/resto-list', [RestoListController::class, 'index'])->name('all_resto_list');
    Route::get('/resto-list/create', [RestoListController::class, 'create'])->name('create_resto_list');
    Route::post('/resto-list/create', [RestoListController::class, 'store'])->name('store_resto_list_detail');
    Route::get('/resto-list/edit/{id}', [RestoListController::class, 'edit'])->name('edit_resto_list');
    Route::put('/resto-list/edit/{id}', [RestoListController::class, 'update'])->name('update_resto_list');
    Route::delete('/resto-list/{id}', [RestoListController::class, 'destroy'])->name('destroy_resto_list');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::middleware(['auth', 'isRestaurant'])->group(function () {
    Route::resource('/resto/resto-list', RestoListController::class)->except(['create', 'store', 'destroy']);
    // Route::get('/restaurant', [RestoListController::class, 'index'])->name('restaurant.index');
    // Route::get('/restaurant/edit', [RestoListController::class, 'edit'])->name('restaurant.edit');
    // Route::post('/restaurant/update', [RestoListController::class, 'update'])->name('restaurant.update');
});

Route::get('/profile/edit', [ContentController::class, 'editProfile'])->name('edit_profile');
Route::put('/profile/edit', [ContentController::class, 'updateProfile'])->name('update_profile');


Route::get('/resto-list/{id}', [RestoListController::class, 'show'])->name('resto_list_detail');

Route::get('/resto-list/{id}', [RestoListController::class, 'showReview'])->name('show_review');
Route::post('/order/{id}', [ReviewController::class, 'orderTicket'])->name('order_ticket');
Route::get('/histories', [ReviewController::class, 'reviewHistory'])->name('review_history');
Route::get('/success-review', [ContentController::class, 'success_review']);
Route::any('/search', [ContentController::class, 'search'])->name('search');
Route::get('/reset_password', [ContentController::class, 'resetPassword'])->name('reset_password');

Route::get('/my-profile', [ContentController::class, 'profile'])->name('show_profile')->middleware('auth');
Route::put('/my-profile', [ContentController::class, 'editProfile'])->name('edit_profile')->middleware('auth');


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeuController::class, 'index'])->name('home');
Route::get('/forum', [PostController::class, 'index'])->name('forum.index');
Route::post('/forum', [PostController::class, 'store'])->name('forum.store');
Route::post('/reviews/{id}', [ReviewController::class, 'store'])->name('create_reviews');
