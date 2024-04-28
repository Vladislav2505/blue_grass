<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Throwable;

final class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): HttpResponse
    {
        $tableHeaders = ['ID', 'ФИО', 'Email', 'Дата регистрации', 'Верифицирован', 'Администратор'];

        $users = User::query()
            ->where('email', '!=', config('site.admin_email'))
            ->orderByDesc('is_admin')
            ->orderByDesc('created_at')
            ->paginate(self::PER_PAGE);

        return Response::view('admin.users.index', compact('users', 'tableHeaders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): HttpResponse
    {
        return Response::view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'last_name' => ['required', 'string', 'max:180'],
            'first_name' => ['required', 'string', 'max:180'],
            'patronymic' => ['nullable', 'string', 'max:180'],
            'email' => ['required', 'email:rfc,dns', 'max:80', Rule::unique('users')],
            'password' => ['required', 'string', Password::min(8)->max(255)->letters()->numbers()->symbols()],
            'is_admin' => ['nullable', 'in:true,on'],
        ]);

        try {
            $user = User::create($data);
            Event::dispatch(new Registered($user));
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return Response::redirectToRoute('admin.users.index')
                ->withErrors(['error' => __('admin.user_creation_error')]);
        }

        return Response::redirectToRoute('admin.users.index')
            ->with(['success' => __('admin.users-create-success', ['name' => $user->full_name])]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): HttpResponse
    {
        return Response::view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): RedirectResponse|HttpResponse
    {
        if ($user->id !== Auth::id()) {
            return Response::redirectToRoute('admin.users.index');
        }

        return Response::view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $updatedData = $request->validate([
            'last_name' => ['required', 'string', 'max:180'],
            'first_name' => ['required', 'string', 'max:180'],
            'patronymic' => ['nullable', 'string', 'max:180'],
            'email' => ['required', 'email:rfc,dns', 'max:80', Rule::unique('users')->ignore($user->id)],
        ]);

        try {
            $user->update($updatedData);
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return Response::redirectToRoute('admin.users.index')
                ->withErrors(['error' => __('admin.user_update_error')]);
        }

        return Response::redirectToRoute('admin.users.index')
            ->with(['success' => __('admin.user_update_success', ['name' => $user->full_name])]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        try {
            $user->deleteWithNotification();
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return Response::redirectToRoute('admin.users.index')
                ->withErrors(['error' => __('admin.user_delete_error')]);
        }

        return Response::redirectToRoute('admin.users.index')
            ->with(['success' => __('admin.user_delete_success', ['name' => $user->full_name])]);
    }
}
