<?php

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

Route::middleware('auth:sanctum')->controller(UserController::class)->prefix('users')->as('users.')->group(function () {
    Route::get('index', 'index')->middleware('permission:user.index')->name('index');
    Route::get('ME', 'me')->middleware('permission:me')->name('dashboard');
    Route::post('update_profile', 'update')->middleware('permission:profile.update')->name('update_profile');
    Route::delete('delete', 'destroy')->middleware('permission:user.delete')->name('delete');
    Route::post('reset_password','resetPassword')->middleware('permission:reset.password')->name('reset_password');
});

//ProductRoute
Route::middleware('auth:sanctum')->prefix('products')->group(function () {
    Route::get('index', )->name('products.index');
    Route::post('store',)->name('Products.store');
    Route::put('update/{id}',  'update')->name('products.update');
    Route::delete('delete/{id}','destroy')->name('products.destroy');
    Route::post('restore/{id}','restore')->name('products.restore');
});
