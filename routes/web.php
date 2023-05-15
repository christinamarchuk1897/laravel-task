<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Chat\ChatsController;

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


Route::get('{any}', function () {
    return view('welcome');
})->whereIn('any', ['login', 'logout', 'register', 'dashboard', 'forgot-password', 'reset-password', '']);

//rewrite later
Route::get('/chat/{id}', function () {
    return view('welcome');
});


Route::post('/forgot-password', [ForgotPasswordController::class, 'submitEmailMessage'])->middleware('guest')->name('forget.password.get');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->middleware('guest')->name('reset.password.get');
Route::get('/email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify'); // Make sure to keep this as your route name
Route::get('/email/resend', [VerificationController::class,'resend'])->name('verification.resend');
Auth::routes(['verify' => true]);


Route::middleware(['auth','verify'])->group(function () {
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/all', [UserController::class, 'getAll']);
    Route::post('/user/contact/add', [UserController::class, 'add']);
    Route::post('/user/contact/remove', [UserController::class, 'remove']);

    Route::get('/chat/{contact_id}/messages', [ChatsController::class, 'fetchMessages']);
    Route::post('/chat/{contact_id}/messages', [ChatsController::class, 'sendMessage']);
    Route::get('/chat/latest/{user_id}', [ChatsController::class, 'fetchLatestMessage']);

    Route::get('/home', [HomeController::class, 'index'])->name('home');
});