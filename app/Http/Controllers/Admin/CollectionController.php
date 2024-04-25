<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StorageType;
use App\Http\Controllers\Controller;
use App\Http\Requests\CollectionPostRequest;
use App\Models\Collection;
use App\Services\FileService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Throwable;

final class CollectionController extends Controller
{
    public function __construct(
        private readonly FileService $fileService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): HttpResponse
    {
        $tableHeaders = ['ID', 'Название коллекции', 'Дата обновления', 'Активность'];

        $collections = Collection::query()
            ->select('id', 'name', 'slug', 'updated_at', 'is_active')
            ->orderBy('updated_at', 'desc')
            ->paginate(self::PER_PAGE);

        return Response::view('admin.collections.index', compact('collections', 'tableHeaders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): HttpResponse
    {
        return Response::view('admin.collections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CollectionPostRequest $request): RedirectResponse
    {
        $request->validate([
            'name' => ['unique:collections'],
        ]);

        try {
            $data = $request->safe()->except('images');

            $data['images'] = collect($request->file('images'))
                ->map(function ($file) {
                    return $this->fileService->saveFile($file, StorageType::Collections);
                })
                ->filter();

            Collection::query()->create($data);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Response::redirectToRoute('admin.collections.index')
                ->withErrors(['error' => __('admin.collection_creation_error')]);
        }

        return Response::redirectToRoute('admin.collections.index')
            ->with(['success' => __('admin.collection_creation_success', ['name' => $request->post('name')])]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Collection $collection): HttpResponse
    {
        $images = collect($collection->images)
            ->map(fn ($path) => $this->fileService->getFileUrl($path));

        $collection->setAttribute('images', $images);

        return Response::view('admin.collections.edit', compact('collection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CollectionPostRequest $request, Collection $collection): RedirectResponse
    {
        try {
            $images = $request->file('images') ?? [];
            $loadedImages = collect($request->post('loadedImages'))
                ->map(fn ($file) => ltrim(urldecode($file), config('app.url').'/storage'));
            $currentImages = $collection->images;

            $updatedData = $request->safe()->except('images');

            if (! empty($images)) {
                $updatedData['images'] = collect($images)
                    ->map(fn ($file) => $this->fileService->saveFile($file, StorageType::Collections))
                    ->merge($loadedImages);
            } elseif ($loadedImages !== null) {
                $updatedData['images'] = $loadedImages;
            } else {
                $updatedData['images'] = $currentImages;
            }

            $this->fileService->syncFiles($currentImages, $loadedImages);

            $collection->update($updatedData);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Response::redirectToRoute('admin.collections.index')
                ->withErrors(['error' => __('admin.collection_update_error')]);
        }

        return Response::redirectToRoute('admin.collections.index')
            ->with(['success' => __('admin.collection_update_success'), ['name' => $request->post('name')]]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Collection $collection): RedirectResponse
    {
        try {
            DB::transaction(function () use ($collection) {
                $collection->deleteOrFail();
                $this->fileService->deleteFiles($collection->images);
            });
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return Response::redirectToRoute('admin.collections.index')
                ->withErrors(['error' => __('admin.collection_delete_error')]);
        }

        return Response::redirectToRoute('admin.collections.index')
            ->with('success', __('admin.collection_delete_success', ['name' => $collection->name]));
    }
}
