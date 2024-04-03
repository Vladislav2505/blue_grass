<?php

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
    return view('auth.email-verification-form');
})->name('ver')->middleware('auth');

Route::get('/auth', function () {
    return view('auth.auth-form');
});

Route::get('/rec', function () {
    return view('auth.password-recovery-form');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegistrationController::class, 'render'])->name('register');
    Route::post('/register', [RegistrationController::class, 'register'])->name('register');

    Route::get('/login', [LoginController::class, 'render'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'render'])->name('forgot-password');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendEmail'])->name('forgot-password');

    Route::get('/reset-password', [ResetPasswordController::class, 'render'])->name('password.reset');
});
