<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

final class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): HttpResponse
    {
        $tableHeaders = ['ID', 'Название', 'Дата обновления', 'Активность'];
        $themes = Theme::query()->orderBy('updated_at', 'desc')->paginate(self::PER_PAGE);

        return Response::view('admin.themes.index', compact('themes', 'tableHeaders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): HttpResponse
    {
        return Response::view('admin.themes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80', 'unique:themes'],
            'is_active' => ['nullable', 'in:true,false,on'],
        ]);

        try {
            Theme::query()->create([
                'name' => $data['name'],
                'is_active' => (bool) ($data['is_active'] ?? false),
            ]);

            return Response::redirectToRoute('admin.themes.index')
                ->with(['success' => __('admin.theme_creation_success', ['name' => $data['name']])]);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Response::redirectToRoute('admin.themes.index')
                ->withErrors(['error' => __('admin.theme_creation_error')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Theme $theme): HttpResponse
    {
        return Response::view('admin.themes.edit', compact('theme'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Theme $theme): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80'],
            'is_active' => ['nullable', 'in:true,false,on'],
        ]);

        try {
            $theme->update([
                'name' => $data['name'],
                'is_active' => (bool) ($data['is_active'] ?? false),
            ]);

            return Response::redirectToRoute('admin.themes.index')
                ->with(['success' => __('admin.theme_update_success', ['name' => $data['name']])]);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Response::redirectToRoute('admin.themes.index')
                ->withErrors(['error' => __('admin.theme_update_error')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Theme $theme): RedirectResponse
    {
        if ($theme->events()->exists()) {
            throw ValidationException::withMessages(
                ['error' => __('admin.theme_delete_error')],
            );
        }

        $theme->delete();

        return Response::redirectToRoute('admin.themes.index')
            ->with(['success' => __('admin.theme_delete_success', ['name' => $theme->name])]);
    }
}
