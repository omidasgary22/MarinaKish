<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\RulesController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\OffcodeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifingCodeController;
use App\Models\Passenger;
use App\Models\User;
use App\Models\VerivingCode;
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
Route::get('products/index/{id?}',[ProductController::class ,'index'] )->name('products.index');
Route::get('rules/index{id?}',[RulesController::class,'index'])->name('rules.index');
Route::get('blogs/index/{id?}',[BlogController::class,'index'])->name('blogs.bindex');
Route::post('verifing/{type}',[VerifingCodeController::class,'MakeCode'])->name('make code');
Route::post('forgot_password',[UserController::class,'forgotPassword'])->name('forgot_password');

Route::middleware('auth:sanctum')->controller(UserController::class)->prefix('users')->as('users.')->group(function () {
    Route::get('index', 'index')->middleware('permission:user.index')->name('index');
    Route::get('ME', 'me')->middleware('permission:me')->name('dashboard');
    Route::put('update_profile', 'update')->middleware('permission:profile.update')->name('update_profile');
    Route::delete('delete', 'destroy')->middleware('permission:user.delete')->name('delete');
    Route::post('chpass','chpassword')->middleware('permission:reset.password')->name('reset_password');
    Route::delete('logout','logout')->name('logout');
});
Route::middleware('auth:sanctum')->controller(ProductController::class)->prefix('products')->group(function () {
    Route::get('admin/index/{id?}','admin_index')->middleware('permission:product.index')->name('admin index');
    Route::post('store', 'store')->middleware('permission:product.create')->name('store');
    Route::put('update/{id}',  'update')->middleware('permission:product.update')->name('update');
    Route::delete('delete/{id}', 'destroy')->middleware('permission:product.delete')->name('destroy');
    Route::post('restore/{id}', 'restore')->middleware('permission:product.restore')->name('restore');
});
Route::middleware('auth:sanctum')->prefix('orders')->controller(OrderController::class)->as('orders.')->group(function (){
    Route::get('admin/index/{id?}','admin_index')->middleware('permission:order.admin.index')->name('admin index');
    Route::post('store','store')->middleware('permission:order.create')->name('store');
    Route::delete('cancel/{id}','destroy')->middleware('permission:order.delete')->name('cancel');
});
Route::middleware('auth:sanctum')->controller(MediaController::class)->prefix('media')->as('media.')->group(function () {
    Route::post('save_image/profile', 'profile')->name('profile');
    Route::post('/save_image/product/{id}', 'product')->name('product');
    Route::post('save_image/blog/{id}', 'blog')->name('blog');
});
Route::middleware('auth:sanctum')->controller(TicketController::class)->prefix('tickets')->as('tickets.')->group(function () {
    Route::get('/index/{id?}', 'index')->middleware('permission:ticket.index')->name('index');
    Route::get('ticket_admin/{id?}','admin_index')->middleware('permission:ticket.admin.index')->name('admin index');
    Route::post('/store','store')->middleware('permission:ticket.create')->name('store');
    Route::put('/update/{id}','update')->middleware('permission:ticket.update')->name('update');
    Route::delete('/delete/{id}','destroy')->middleware('permission:ticket.delete')->name('delete');
});
Route::middleware('auth:sanctum')->controller(RulesController::class)->prefix('rules')->as('rules.')->group(function () {
    Route::get('index/admin/{id?}','admin_index')->middleware('permission:rule.index')->name('admin index');
    Route::post('/store','store')->middleware('permission:rule.create')->name('store');
    Route::put('/update/{id}','update')->middleware('permission:rule.update')->name('update');
    Route::delete('/delete/{id}','destroy')->middleware('permission:rule.delete')->name('destroy');
    Route::post('/restore/{id}','restore')->middleware('permission:rule.restore')->name('restore');
});

Route::middleware('auth:sanctum')->controller(BlogController::class)->prefix('blogs')->as('blogs.')->group(function () {
    Route::get('index/admin/{id?}')->middleware('permission:blog.index')->name('admin index');
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
Route::middleware('auth:sanctum')->controller(OffcodeController::class)->prefix('off_codes')->as('off_codes.')->group(function(){
    Route::get('index/{id?}','index')->middleware('permission:off_code.index')->name('index');
    Route::post('store','store')->middleware('permission:off_code.create')->name('store');
    Route::get('use/{code_id}/{factor_id}','use')->middleware('permission:off_code.use')->name('use');
    Route::put("update/{id}",'update')->middleware('permission:off_code.update')->name('update');
    Route::delete('delete/{id}','delete')->middleware('permission:off_code.delete')->name('delete');
    Route::post('restore/{id}','restore')->middleware('permission:off_code.restore')->name('restore');
});
Route::middleware('auth:sanctum')->controller(PassengerController::class)->prefix('passengers')->as('passengers.')->group(function(){
    Route::get('index/{id?}','index')->middleware('permission:passenger.index')->name('index');
    Route::post('store','store')->middleware('permission:passenger.create')->name('store');
    Route::put('update/{id}','update')->middleware('permission:passenger.update')->name('update');
    Route::delete('delete/{id}','destroy')->middleware('permission:passenger.delete')->name('destroy');
});
Route::middleware('auth:sanctum')->controller(TransactionController::class)->prefix('transactions')->as('transactions.')->group(function(){
    Route::get('store/{id}','store')->name('store');
});
Route::middleware('auth:sanctum')->controller(SettingController::class)->prefix('settings')->as('settings.')->group(function(){
    Route::get('index/{id?}','index')->middleware('permission:setting.index')->name('index');
    Route::put('update/{id}','update')->middleware('permission:setting.update')->name('update');
    Route::post('logo','logo')->middleware('permission:setting.logo')->name('logo');
});
