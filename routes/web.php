<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

Route::get('/logout', function () {
    Auth::logout();

    return redirect(RouteServiceProvider::HOME);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ver', function () {
    return view('auth.email-verification');
})->middleware(['verified'])->name('ver');

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegistrationController::class, 'render'])->name('register');
    Route::post('/register', [RegistrationController::class, 'register'])->name('register');

    Route::get('/login', [LoginController::class, 'render'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'render'])->name('forgot-password');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'send'])->name('forgot-password');

    Route::get('/reset-password', [ResetPasswordController::class, 'render'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.reset');
});

Route::middleware(['auth'])->group(function () {
    Route::middleware(['verified'])->group(function () {
        Route::get('/profile', function () {
            return '123123123';
        })->name('profile');
    });

    Route::prefix('email')->group(function () {
        Route::get('/verify', [EmailVerificationController::class, 'notice'])->name('verification.notice');
        Route::get('/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware('signed')->name('verification.verify');
    });
});
