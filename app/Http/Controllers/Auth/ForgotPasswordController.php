<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Rules\RecaptchaRule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Response;

final class ForgotPasswordController extends Controller
{
    public function render(): HttpResponse
    {
        return Response::view('auth.forgot-password');
    }

    public function send(Request $request): RedirectResponse
    {
        if ($request->has('accept') && ! $request->has('email')) {
            return Response::redirectToRoute('login');
        }

        $request->validate([
            'email' => ['required', 'email'],
            'g-recaptcha-response' => ['required', new RecaptchaRule()],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
}
