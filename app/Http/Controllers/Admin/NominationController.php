<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nomination;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

final class NominationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): HttpResponse
    {
        $tableHeaders = ['ID', 'Название', 'Дата обновления', 'Активность'];
        $nominations = Nomination::query()->orderBy('updated_at', 'desc')->paginate(self::PER_PAGE);

        return Response::view('admin.nominations.index', compact('nominations', 'tableHeaders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): HttpResponse
    {
        return Response::view('admin.nominations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80', 'unique:nominations'],
            'is_active' => ['nullable', 'in:true,false,on'],
        ]);

        try {
            Nomination::query()->create([
                'name' => $data['name'],
                'is_active' => (bool) ($data['is_active'] ?? false),
            ]);

            return Response::redirectToRoute('admin.nominations.index')
                ->with(['success' => __('admin.nomination_creation_success', ['name' => $data['name']])]);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Response::redirectToRoute('admin.nominations.index')
                ->withErrors(['error' => __('admin.nomination_creation_error')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nomination $nomination): HttpResponse
    {
        return Response::view('admin.nominations.edit', compact('nomination'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nomination $nomination): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80'],
            'is_active' => ['nullable', 'in:true,false,on'],
        ]);

        try {
            $nomination->update([
                'name' => $data['name'],
                'is_active' => (bool) ($data['is_active'] ?? false),
            ]);

            return Response::redirectToRoute('admin.nominations.index')
                ->with(['success' => __('admin.nomination_creation_success', ['name' => $data['name']])]);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Response::redirectToRoute('admin.nominations.index')
                ->withErrors(['error' => __('admin.nomination_creation_error')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nomination $nomination): RedirectResponse
    {
        if ($nomination->events()->exists()) {
            throw ValidationException::withMessages(
                ['error' => __('admin.nomination_delete_error')],
            );
        }

        $nomination->delete();

        return Response::redirectToRoute('admin.nominations.index')
            ->with(['success' => __('admin.nomination_delete_success', ['name' => $nomination->name])]);
    }
}
