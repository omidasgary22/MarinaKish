<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RulesController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
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

Route::post('register', [UserController::class, 'create'])->name('register');
Route::post('login', [UserController::class, 'login'])->name('login');
Route::get('products/index/{id?}',[ProductController::class ,'index'] )->name('product.index');
Route::delete('logout', [UserController::class, 'logout'])->name('logout');

Route::middleware('auth:sanctum')->controller(UserController::class)->prefix('users')->as('users.')->group(function () {
    Route::get('index', 'index')->middleware('permission:user.index')->name('index');
    Route::get('ME', 'me')->middleware('permission:me')->name('dashboard');
    Route::put('update_profile', 'update')->middleware('permission:profile.update')->name('update_profile');
    Route::delete('delete', 'destroy')->middleware('permission:user.delete')->name('delete');

    Route::post('reset_password', 'resetPassword')->name('reset_password');
    Route::post('reset_password','resetPassword')->middleware('permission:reset.password')->name('reset_password');
});
Route::middleware('auth:sanctum')->controller(ProductController::class)->prefix('products')->group(function () {
    Route::post('store','store')->middleware('permission:product.create')->name('store');
    Route::put('update/{id}',  'update')->middleware('permission:product.update')->name('update');
    Route::delete('delete/{id}','destroy')->middleware('permission:product.delete')->name('destroy');
    Route::post('restore/{id}','restore')->middleware('permission:product.restore')->name('restore');
});
Route::middleware('auth:sanctum')->prefix('orders')->controller(OrderController::class)->as('orders.')->group(function (){
    Route::get('index', 'index')->name('index');
    Route::post('store','store')->name('store');
});
Route::middleware('auth:sanctum')->controller(MediaController::class)->prefix('media')->as('media.')->group(function (){
    Route::post('save_image/{model}/{id?}','save_image')->name('save');
});

//TicketRoute
Route::prefix('tickets')->group(function () {
    Route::get('/index', [TicketController::class, 'index'])->name('tickets.index');
    Route::post('/store', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/show/{id}', [TicketController::class, 'show'])->name('tickets.show');
    Route::put('/update/{id}', [TicketController::class, 'update'])->name('tickets.update');
    Route::delete('/delete/{id}', [TicketController::class, 'destroy'])->name('tikets.destroy');
    Route::post('/restore/{id}', [TicketController::class, 'restore'])->name('tickets.restore');
});

//RuleRoute
Route::prefix('rules')->group(function () {
    Route::get('/index/{id?}', [RulesController::class, 'index'])->name('rules.index');
    Route::post('/store', [RulesController::class, 'store'])->name('rules.store');
    Route::put('/update/{id}', [RulesController::class, 'update'])->name('rules.update');
    Route::delete('/delete/{id}', [RulesController::class, 'destroy'])->name('rules.destroy');
    Route::post('/restore/{id}', [RulesController::class, 'restore'])->name('rules.restore');
});

//BlogRoute
Route::prefix('blogs')->group(function () {
    Route::get('/index', [BlogController::class, 'index'])->name('blogs.index');
    Route::post('/store', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/show/{id}', [BlogController::class, 'show'])->name('blogs.show');
    Route::put('/update/{id}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('/delete/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');
    Route::post('/restore/{id}', [BlogController::class, 'restore'])->name('blogs.restore');
});

//CommentRoute
Route::prefix('comments')->group(function () {
    Route::get('/index{id?}', [CommentController::class, 'index'])->name('comments.index');
    Route::post('/store', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/update/{id}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/delete/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/restore/{id}', [CommentController::class, 'restore'])->name('comments.restore');
    Route::get('/show/{id}', [CommentController::class, 'show'])->name('comments.show');
});

