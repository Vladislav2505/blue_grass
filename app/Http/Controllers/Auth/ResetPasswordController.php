<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rules\Password as PasswordRule;

final class ResetPasswordController extends Controller
{
    /**
     * Рендеринг формы сброса пароля.
     *
     * @param  Request  $request  Запрос пользователя.
     */
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

    /**
     * Сброс пароля пользователя.
     *
     * @param  Request  $request  Запрос пользователя.
     */
    public function reset(Request $request, UserService $userService): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email:rfc,dns', 'max:80'],
            'password' => ['required', 'string', 'confirmed', PasswordRule::min(8)->max(255)->letters()->numbers()->symbols()],
            'token' => ['required', 'string'],
        ]);

        $status = $userService->resetPassword($request->only(['email', 'password', 'password_confirmation', 'token']));

        return $status === Password::PASSWORD_RESET
            ? Response::redirectToRoute('login')->with(['status' => __($status)])
            : Redirect::back()->withErrors(['email' => __($status)]);
    }
}
