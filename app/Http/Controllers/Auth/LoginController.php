<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function render(): Response
    {
        return \Response::view('auth.auth-form');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => 'Имя пользователя или пароль не совпадают.',
            ]);
        }

        return Redirect::intended(RouteServiceProvider::HOME);
    }
}
