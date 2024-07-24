<?php

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

Route::middleware('auth:sanctum')->controller(UserController::class)->prefix('users')->as('users.')->group(function () {
    Route::get('index', 'index')->middleware('permission:user.index')->name('index');
    Route::get('ME', 'me')->middleware('permission:me')->name('dashboard');
    Route::put('update_profile', 'update')->middleware('permission:profile.update')->name('update_profile');
    Route::delete('delete', 'destroy')->middleware('permission:user.delete')->name('delete');
    Route::post('reset_password','resetPassword')->middleware('permission:reset.password')->name('reset_password');
});
Route::middleware('auth:sanctum')->controller(ProductController::class)->prefix('products')->group(function () {
    Route::post('store','store')->middleware('permission:product.create')->name('store');
    Route::put('update/{id}',  'update')->middleware('permission:product.update')->name('update');
    Route::delete('delete/{id}','destroy')->middleware('permission:product.delete')->name('destroy');
    Route::post('restore/{id}','restore')->middleware('permission:product.restore')->name('restore');
});
