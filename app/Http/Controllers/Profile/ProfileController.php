<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Throwable;

final class ProfileController extends Controller
{
    public function dashboard(): HttpResponse
    {
        return Response::view('profile.dashboard');
    }

    private function getUser(): User
    {
        return Auth::user();
    }

    public function edit(): HttpResponse
    {
        $user = $this->getUser();

        return Response::view('profile.edit', compact('user'));
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $this->getUser();

        $updatedProfileData = $request->validate([
            'last_name' => ['required', 'string', 'max:180'],
            'first_name' => ['required', 'string', 'max:180'],
            'patronymic' => ['nullable', 'string', 'max:180'],
            'phone' => ['nullable', 'string', 'regex:/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/'],
            'date_of_birth' => ['nullable', 'date_format:Y-m-d', 'before_or_equal:today'],
            'address' => ['nullable', 'string', 'max:180'],
        ]);

        $request->merge(['subscribed_to_notifications' => $request->boolean('subscribed_to_notifications') ?? false]);
        $updatedUserData = $request->validate(['subscribed_to_notifications' => ['nullable', 'boolean']]);

        try {
            DB::transaction(static function () use ($updatedUserData, $updatedProfileData, $user) {
                $user->update($updatedUserData);
                $user->profile()->update($updatedProfileData);
            });
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return Response::redirectToRoute('profile.dashboard')
                ->withErrors(['error' => __('profile.profile_update_error')]);
        }

        return Response::redirectToRoute('profile.dashboard')
            ->with(['success' => __('profile.profile_update_success')]);
    }

    public function security(): HttpResponse
    {
        return Response::view('profile.security');
    }

    public function resetPassword(Request $request, UserService $userService): RedirectResponse
    {
        $user = $this->getUser();

        $request->validate([
            'current_password' => ['required', 'string', function ($attribute, $value, $fail) use ($user) {
                if (! Hash::check($value, $user->password)) {
                    $fail(__('Поле :attribute не совпадает.'));
                }
            }],
            'password' => ['required', 'string', 'confirmed', PasswordRule::min(8)->max(255)->letters()->numbers()->symbols()],
        ]);

        try {
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            $userService->logout($request);
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return Response::redirectToRoute('profile.security')
                ->withErrors(['error' => __('profile.password_update_error')]);
        }

        return Response::redirectToRoute('login.render')
            ->with(['status' => __('profile.password_update_success')]);
    }
}
