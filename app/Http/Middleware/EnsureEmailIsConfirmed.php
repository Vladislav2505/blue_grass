<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsConfirmed
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user() || ($request->user() instanceof MustVerifyEmail && $request->user()->hasVerifiedEmail())) {
            $request->expectsJson()
                ? abort(403, 'Your email address has already been verified')
                : Redirect::route(RouteServiceProvider::PROFILE);
        }

        return $next($request);
    }
}
