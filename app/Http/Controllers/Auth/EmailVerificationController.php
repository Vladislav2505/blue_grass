<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

class EmailVerificationController extends Controller
{
    public function notice(): HttpResponse
    {
        $user = User::query()->find(\Auth::id())?->getModel();
        \Event::dispatch(new Registered($user));

        return Response::view('auth.verification-notice');
    }

    public function verify(EmailVerificationRequest $request): RedirectResponse
    {
        $request->fulfill();

        return Response::redirectToRoute(RouteServiceProvider::PROFILE);
    }
}
