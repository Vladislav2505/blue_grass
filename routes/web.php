<?php

use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('index');
});

Route::get('/', function () {
    return view('welcome');
})->name('index');

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
    Route::prefix('email')->middleware(['confirmed'])->group(function () {
        Route::get('/verify', [EmailVerificationController::class, 'notice'])->name('verification.notice');
        Route::post('/verify', [EmailVerificationController::class, 'resend'])->name('verification.resend');
        Route::get('/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware('signed')->name('verification.verify');
    });

    Route::name('profile.')->prefix('profile')->middleware(['verified', 'user'])->group(function () {
        Route::get('/', function () {
            return view('test2');
        })->name('dashboard');
    });

    Route::name('admin.')->prefix('admin')->middleware(['admin'])->group(function () {
        Route::redirect('/', 'admin/events')->name('dashboard');

        Route::resources([
            'events' => EventController::class,
        ]);
    });
});
