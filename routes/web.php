<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.reg-form');
});

Route::get('/ver', function () {
    return view('auth.email-verification-form');
});

Route::get('/auth', function () {
    return view('auth.auth-form');
});

Route::get('/rec', function () {
    return view('auth.password-recovery-form');
});
