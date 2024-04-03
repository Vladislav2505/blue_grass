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
        return \Response::view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'remember-me' => ['sometimes', 'in:on,true'],
        ]);

        $email = $request->string('email');
        $password = $request->string('password');
        $remember = $request->boolean('remember-me');

        if (! Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            throw ValidationException::withMessages([
                'email' => 'Имя пользователя или пароль не совпадают.',
            ]);
        }

        $request->session()->regenerate();

        return Redirect::intended(RouteServiceProvider::HOME);
    }
}
