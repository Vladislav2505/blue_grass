<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.reg-form');
});

Route::get('/ver', function () {
    return view('auth.email-verification-form');
})->name('ver');

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
});
