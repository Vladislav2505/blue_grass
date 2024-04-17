<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StorageType;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventPostRequest;
use App\Models\Event;
use App\Models\Location;
use App\Models\Nomination;
use App\Models\Theme;
use App\Services\FileService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Throwable;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): HttpResponse
    {
        $tableHeaders = ['ID', 'Название мероприятия', 'Дата проведения', 'Место проведения', 'Тема', 'Активность'];

        $events = Event::query()
            ->select(['id', 'name', 'date_of', 'location_id', 'theme_id', 'is_active'])
            ->with(['location:id,name', 'theme:id,name'])
            ->orderBy('updated_at', 'desc')
            ->paginate(self::PER_PAGE);

        return Response::view('admin.events.index', compact('events', 'tableHeaders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): HttpResponse
    {
        $themes = Theme::query()
            ->select(['id', 'name'])
            ->where('is_active', true)
            ->get();
        $locations = Location::query()
            ->select(['id', 'name'])
            ->where('is_active', true)
            ->get();
        $nominations = Nomination::query()
            ->select(['id', 'name'])
            ->where('is_active', true)
            ->get();

        return Response::view('admin.events.create', compact('themes', 'locations', 'nominations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventPostRequest $request, FileService $fileService): RedirectResponse
    {
        try {
            DB::transaction(static function () use ($fileService, $request) {
                /** @var Event $event */
                $event = Event::query()->create($request->safe()->except('image', 'nominations'));

                $event->image = $fileService->saveFile($request->file('image'), StorageType::Events);
                $event->nominations()->sync($request->post('nominations', []));

                $event->save();
            });
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Response::redirectToRoute('admin.events.index')
                ->withErrors(['error' => __('admin.event_creation_error')]);
        }

        return Response::redirectToRoute('admin.events.index')
            ->with(['success' => __('admin.event_creation_success', ['name' => $request->post('name')])]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event, FileService $fileService): HttpResponse
    {
        $event->setAttribute('nomination_ids', $event->nominations->pluck('id'));
        $event->setAttribute('image_url', $fileService->getFileUrl($event->image ?? ''));

        $themes = Theme::query()
            ->select(['id', 'name'])
            ->where('is_active', true)
            ->get();
        $locations = Location::query()
            ->select(['id', 'name'])
            ->where('is_active', true)
            ->get();
        $nominations = Nomination::query()
            ->select(['id', 'name'])
            ->where('is_active', true)
            ->get();

        return Response::view('admin.events.edit', compact('event', 'themes', 'locations', 'nominations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventPostRequest $request, FileService $fileService, Event $event): RedirectResponse
    {
        try {
            DB::transaction(static function () use ($event, $fileService, $request) {
                $file = $request->file('image');
                $oldFile = $event->image ?? '';
                $updatedData = $request->safe()->except('image', 'nominations');

                if ($request->has('image')) {
                    $imageUrl = $fileService->saveFile($file, StorageType::Events);
                    if (! empty($imageUrl)) {
                        $fileService->deleteFile($oldFile);
                        $updatedData['image'] = $imageUrl;
                    }
                } else {
                    $updatedData['image'] = $oldFile;
                }

                $event->update($updatedData);
                $event->nominations()->sync($request->post('nominations', []));
            });
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Response::redirectToRoute('admin.events.index')
                ->withErrors(['error' => __('admin.event_update_error')]);
        }

        return Response::redirectToRoute('admin.events.index')
            ->with(['success' => __('admin.event_update_success', ['name' => $request->post('name')])]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event): RedirectResponse
    {
        try {
            $event->deleteOrFail();
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return Response::redirectToRoute('admin.events.index')
                ->withErrors(['error' => __('event_delete_error')]);
        }

        return Response::redirectToRoute('admin.events.index')
            ->with('success', __('admin.event_delete_success', ['name' => $event->name]));
    }
}
