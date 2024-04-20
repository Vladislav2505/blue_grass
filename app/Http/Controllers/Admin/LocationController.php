<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

final class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): HttpResponse
    {
        $tableHeaders = ['ID', 'Место проведения', 'Дата обновления', 'Активность'];
        $locations = Location::query()->orderBy('updated_at', 'desc')->paginate(self::PER_PAGE);

        return Response::view('admin.locations.index', compact('locations', 'tableHeaders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): HttpResponse
    {
        return Response::view('admin.locations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80', 'unique:locations'],
            'is_active' => ['nullable', 'in:true,false'],
        ]);

        try {
            Location::query()->create([
                'name' => $data['name'],
                'is_active' => (bool) ($data['is_active'] ?? false),
            ]);

            return Response::redirectToRoute('admin.locations.index')
                ->with(['success' => __('admin.location_creation_success', ['name' => $data['name']])]);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Response::redirectToRoute('admin.locations.index')
                ->withErrors(['error' => __('admin.location_creation_error')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location): HttpResponse
    {
        return Response::view('admin.locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80', 'unique:locations'],
            'is_active' => ['nullable', 'in:true,false'],
        ]);

        try {
            $location->update([
                'name' => $data['name'],
                'is_active' => (bool) ($data['is_active'] ?? false),
            ]);

            return Response::redirectToRoute('admin.locations.index')
                ->with(['success' => __('admin.location_update_success', ['name' => $data['name']])]);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Response::redirectToRoute('admin.locations.index')
                ->withErrors(['error' => __('admin.location_update_error')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location): RedirectResponse
    {
        if ($location->events()->exists()) {
            throw ValidationException::withMessages(
                ['error' => __('admin.location_delete_error')],
            );
        }

        $location->delete();

        return Response::redirectToRoute('admin.locations.index')
            ->with(['success' => __('admin.location_delete_success', ['name' => $location->name])]);
    }
}
