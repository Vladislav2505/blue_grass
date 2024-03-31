<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegistrationController extends Controller
{
    public function create(): Response
    {
        return \Response::view('auth.reg-form');
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'last_name' => ['required', 'string', 'max:180'],
            'first_name' => ['required', 'string', 'max:180'],
            'email' => ['required', 'email', 'max:80', Rule::unique('users')],
            'password' => ['required', 'string', 'confirmed', Password::min(8)->max(255)->letters()->numbers()->symbols()],
            'personal-data' => ['accepted'],
        ]);

        $user = User::create($validatedData);
        Auth::login($user);

        return Redirect::route('ver');
    }
}
