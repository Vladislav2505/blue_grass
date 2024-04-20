<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

final class RegistrationController extends Controller
{
    public function render(): HttpResponse
    {
        return Response::view('auth.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'last_name' => ['required', 'string', 'max:180'],
            'first_name' => ['required', 'string', 'max:180'],
            'email' => ['required', 'email:rfc,dns', 'max:80', Rule::unique('users')],
            'password' => ['required', 'string', 'confirmed', Password::min(8)->max(255)->letters()->numbers()->symbols()],
            'personal-data' => ['accepted'],
        ]);

        $user = User::create($validatedData);
        Auth::login($user);

        Event::dispatch(new Registered($user));

        return Redirect::route('verification.notice')->with(['message' => __('auth.send_verification_notification')]);
    }
}
