<?php

use App\Http\Controllers\Admin\CollectionController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\NominationController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ProtocolController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\GlobalController;
use App\Http\Controllers\Main\EventDetailController;
use App\Http\Controllers\Main\GalleryController;
use App\Http\Controllers\Main\IndexController;
use App\Http\Controllers\Main\NewsListController;
use App\Http\Controllers\Main\PartnersController;
use App\Http\Controllers\Main\QuestionFormController;
use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/download-file', [GlobalController::class, 'download'])->name('download.file');
Route::post('/logout', [GlobalController::class, 'logout'])->name('logout');

Route::name('main.')->group(function () {
    Route::get('/', [IndexController::class, 'events'])->name('index.events');
    Route::get('/protocols', [IndexController::class, 'protocols'])->name('index.protocols');
    Route::get('/events/{event}', [EventDetailController::class, 'show'])->name('event.show');

    Route::get('/partners', [PartnersController::class, 'show'])->name('partners.show');
    Route::get('/gallery', [GalleryController::class, 'show'])->name('gallery.show');
    Route::get('/news', [NewsListController::class, 'show'])->name('news.show');
    Route::post('/question', [QuestionFormController::class, 'send'])->name('question');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegistrationController::class, 'render'])->name('register.render');
    Route::post('/register', [RegistrationController::class, 'register'])->name('register');

    Route::get('/login', [LoginController::class, 'render'])->name('login.render');
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'render'])->name('forgot-password.render');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'send'])->name('forgot-password');
    Route::get('/reset-password', [ResetPasswordController::class, 'render'])->name('password.reset.render');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.reset');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('email')->middleware(['confirmed'])->group(function () {
        Route::get('/verify', [EmailVerificationController::class, 'notice'])->name('verification.notice');
        Route::post('/verify', [EmailVerificationController::class, 'resend'])->name('verification.resend');
        Route::get('/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware('signed')->name('verification.verify');
    });

    Route::name('profile.')->prefix('profile')->middleware(['verified', 'user'])->group(function () {
        Route::get('/', [ProfileController::class, 'dashboard'])->name('dashboard');

        Route::get('edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('edit', [ProfileController::class, 'update'])->name('update');
    });

    Route::name('admin.')->prefix('admin')->middleware(['admin'])->group(function () {
        Route::redirect('/', 'admin/events')->name('dashboard');

        Route::resources([
            'users' => UserController::class,
            'events' => EventController::class,
            'themes' => ThemeController::class,
            'locations' => LocationController::class,
            'nominations' => NominationController::class,
            'protocols' => ProtocolController::class,
            'partners' => PartnerController::class,
            'collections' => CollectionController::class,
            'news' => NewsController::class,
        ]);
    });
});
