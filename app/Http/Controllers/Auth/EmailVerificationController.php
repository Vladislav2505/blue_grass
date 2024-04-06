<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class EmailVerificationController extends Controller
{
    public function notice(Request $request): HttpResponse|RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return Redirect::route(RouteServiceProvider::PROFILE);
        }

        return Response::view('auth.verification-notice');
    }

    public function resend(Request $request): RedirectResponse
    {
        if (! $request->has('send')) {
            return Redirect::route(RouteServiceProvider::HOME);
        }

        Event::dispatch(new Registered($request->user()));

        return Redirect::back()->with([
            'message' => __('auth.send_verification_notification'),
        ]);
    }

    public function verify(EmailVerificationRequest $request): RedirectResponse
    {
        $request->fulfill();

        return Response::redirectToRoute(RouteServiceProvider::PROFILE);
    }
}
