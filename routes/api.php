<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RulesController;
use App\Http\Controllers\TicketController;
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
    Route::post('reset_password', 'resetPassword')->name('reset_password');
});

//ProductRoute
Route::prefix('products')->group(function () {
    Route::get('/index', [ProductController::class, 'index'])->name('products.index');
    Route::post('/store', [ProductController::class, 'store'])->name('Products.store');
    Route::put('/update/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::post('/restore/{id}', [ProductController::class, 'restore'])->name('products.restore');
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
