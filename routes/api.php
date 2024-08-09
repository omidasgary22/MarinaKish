<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RulesController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuestionController;
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
Route::get('rules/index{id?}',[RulesController::class,'index'])->name('index');
Route::get('blogs/index/{id?}',[BlogController::class,'index'])->name('index');

Route::middleware('auth:sanctum')->controller(UserController::class)->prefix('users')->as('users.')->group(function () {
    Route::get('index', 'index')->middleware('permission:user.index')->name('index');
    Route::get('ME', 'me')->middleware('permission:me')->name('dashboard');
    Route::put('update_profile', 'update')->middleware('permission:profile.update')->name('update_profile');
    Route::delete('delete', 'destroy')->middleware('permission:user.delete')->name('delete');
    Route::post('reset_password','resetPassword')->middleware('permission:reset.password')->name('reset_password');
    Route::delete('logout','logout')->name('logout');
});
Route::middleware('auth:sanctum')->controller(ProductController::class)->prefix('products')->group(function () {
    Route::post('store', 'store')->middleware('permission:product.create')->name('store');
    Route::put('update/{id}',  'update')->middleware('permission:product.update')->name('update');
    Route::delete('delete/{id}', 'destroy')->middleware('permission:product.delete')->name('destroy');
    Route::post('restore/{id}', 'restore')->middleware('permission:product.restore')->name('restore');
});
Route::middleware('auth:sanctum')->prefix('orders')->controller(OrderController::class)->as('orders.')->group(function (){
    Route::get('index/{id?}', 'index')->middleware('permission:order.index')->name('index');
    Route::post('store','store')->middleware('permission:order.create')->name('store');
    Route::delete('cancel/{id}','destroy')->middleware('permission:order.delete')->name('cancel');
});
Route::middleware('auth:sanctum')->controller(MediaController::class)->prefix('media')->as('media.')->group(function () {
    Route::post('save_image/{model}/{id?}', 'save_image')->name('save');
});
Route::middleware('auth:sanctum')->controller(TicketController::class)->prefix('tickets')->as('tickets.')->group(function () {
    Route::get('/index/{id?}', 'index')->middleware('permission:ticket.index')->name('index');
    Route::post('/store','store')->middleware('permission:ticket.create')->name('store');
    Route::put('/update/{id}','update')->middleware('permission:ticket.update')->name('update');
    Route::delete('/delete/{id}','destroy')->middleware('permission:ticket.delete')->name('delete');
});
Route::middleware('auth:sanctum')->controller(RulesController::class)->prefix('rules')->as('rules.')->group(function () {
    Route::post('/store','store')->middleware('permission:rule.create')->name('store');
    Route::put('/update/{id}','update')->middleware('permission:rule.update')->name('update');
    Route::delete('/delete/{id}','destroy')->middleware('permission:rule.delete')->name('destroy');
    Route::post('/restore/{id}','restore')->middleware('permission:rule.restore')->name('restore');
});

Route::middleware('auth:sanctum')->controller(BlogController::class)->prefix('blogs')->as('blogs.')->group(function () {

    Route::post('/store','store')->middleware('permission:blog.create')->name('store');
    Route::put('/update/{id}','update')->middleware('permission:blog.update')->name('update');
    Route::delete('/delete/{id}','destroy')->middleware('permission:blog.delete')->name('destroy');
    Route::post('/restore/{id}','restore')->middleware('permission:blog.restore')->name('restore');
});
Route::middleware('auth:sanctum')->controller(CommentController::class)->prefix('comments')->as('comment.')->group(function () {
    Route::get('/index{id?}','index')->middleware('permission:comment.index')->name('index');
    Route::post('/store','store')->middleware('permission:comment.create')->name('comments.store');
    Route::delete('/delete/{id}','destroy')->middleware('permission:comment.delete')->name('destroy');
    Route::post('/restore/{id}','restore')->middleware('permission:comment.restore')->name('restore');
});

<<<<<<< HEAD
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

//FAQRoute
Route::prefix('faqs')->group(function () {
    Route::get('/index/{id?}', [QuestionController::class, 'index'])->name('faqs.index');
    Route::post('/store', [QuestionController::class, 'store'])->name('faqs.store');
    Route::put('/update/{id}', [QuestionController::class, 'update'])->name('faqs.update');
    Route::delete('/delete/{id}', [QuestionController::class, 'destroy'])->name('faqs.destroy');
    Route::post('/restore/{id}', [QuestionController::class, 'restore'])->name('faqs.restore');
});

//uplode media to product
//Route::post('/products/upload/{id}', [ProductController::class, 'uplodeImage']); ----->>>Suggested
=======
>>>>>>> dc9f6b788b2860789e62b1e1051a2bf8c6de6fe2
