<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
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

        $request->merge(['subscribed_to_notifications' => $request->boolean('subscribed_to_notifications') ?? false]);
        $updatedUserData = $request->validate([
            'last_name' => ['required', 'string', 'max:180'],
            'first_name' => ['required', 'string', 'max:180'],
            'patronymic' => ['nullable', 'string', 'max:180'],
            'subscribed_to_notifications' => ['nullable', 'boolean'],
        ]);

        $profileData = $request->validate([
            'phone' => ['nullable', 'string', 'regex:/^\+\d{11}$/'],
            'age' => ['nullable', 'integer', 'between:1,100'],
            'address' => ['nullable', 'string', 'max:180'],
            'establishment_name' => ['nullable', 'string', 'max:180'],
            'teacher_full_name' => ['nullable', 'string', 'max:180'],
        ]);


        try {
            DB::transaction(static function () use ($updatedUserData, $user, $profileData) {
                $user->update($updatedUserData);

                if (! empty($profileData)) {
                    $user->profile()->updateOrCreate(['user_id' => $user->id], $profileData);
                }
            });
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return Response::redirectToRoute('profile.dashboard')
                ->withErrors(['error' => __('profile.profile_update_error')]);
        }

        return Response::redirectToRoute('profile.dashboard')
            ->with(['success' => __('profile.profile_update_success')]);
    }
}
