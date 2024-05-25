<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use App\Rules\RecaptchaRule;
use Auth;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
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

    public function register(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'last_name' => ['required', 'string', 'max:180'],
            'first_name' => ['required', 'string', 'max:180'],
            'email' => ['required', 'email:rfc,dns', 'max:80', Rule::unique('users')],
            'password' => ['required', 'string', 'confirmed', Password::min(8)->max(255)->letters()->numbers()->symbols()],
            'personal-data' => ['accepted'],
            'g-recaptcha-response' => ['required', new RecaptchaRule()],
        ]);

        try {
            $user = new User([
                'email' => $validatedData['email'],
                'password' => $validatedData['password'],
            ]);

            DB::transaction(static function () use ($user, $validatedData) {
                $user->save();
                Profile::query()->create([
                    'user_id' => $user->id,
                    'last_name' => $validatedData['last_name'],
                    'first_name' => $validatedData['first_name'],
                ]);
            });
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Redirect::back()->withErrors(['error' => __('auth.registration_failed')]);
        }

        Auth::login($user);

        Event::dispatch(new Registered($user));

        return Redirect::route('verification.notice')->with(['message' => __('auth.send_verification_notification')]);
    }
}
