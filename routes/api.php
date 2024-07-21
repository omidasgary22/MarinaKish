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
    Route::get('/index', 'index')->middleware('permission:user.index')->name('index');
    Route::get('/ME', 'me')->middleware('permission:me')->name('dashboard');
    Route::post('update_profile', 'update')->middleware('permission:profile.update')->name('update_profile');
    Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});
