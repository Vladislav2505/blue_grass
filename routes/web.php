<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('test');
});

Route::get('/test', function () {
    return view('partials.burger-menu');
});

Route::get('/menu', function () {
    return view('html.header');
});
