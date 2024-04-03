<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Str;

class ResetPasswordController extends Controller
{
    public function render(Request $request): RedirectResponse|HttpResponse
    {
        $token = $request->string('token')->toString();

        if (! $token) {
            return Response::redirectToRoute('forgot-password')->withErrors([
                'status' => __('auth.token_required'),
            ]);
        }

        return Response::view('auth.reset-password', compact('token'));
    }

    public function reset(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email:rfc,dns', 'max:80'],
            'password' => ['required', 'string', 'confirmed', PasswordRule::min(8)->max(255)->letters()->numbers()->symbols()],
            'token' => ['required', 'string'],
        ]);

        $status = Password::reset($request->only(['email', 'password', 'password_confirmation', 'token']),
            static function (User $user, string $password) {
                $user->forceFill(['password' => Hash::make($password)])
                    ->setRememberToken(Str::random(60));

                $user->save();
            });

        return $status === Password::PASSWORD_RESET
            ? Response::redirectToRoute('login')->with(['status' => __($status)])
            : Redirect::back()->withErrors(['email' => __($status)]);
    }
}
