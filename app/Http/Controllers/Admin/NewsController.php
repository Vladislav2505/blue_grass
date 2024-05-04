<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StorageType;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsPostRequest;
use App\Models\News;
use App\Services\FileService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Throwable;

final class NewsController extends Controller
{
    public function __construct(
        private readonly FileService $fileService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): HttpResponse
    {
        $tableHeaders = ['ID', 'Название', 'Дата обновления', 'Активность'];

        $news = News::query()
            ->select('id', 'name', 'slug', 'description', 'updated_at', 'is_active')
            ->orderBy('updated_at', 'desc')
            ->paginate(self::PER_PAGE);

        return Response::view('admin.news.index', compact('news', 'tableHeaders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): HttpResponse
    {
        return Response::view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsPostRequest $request): RedirectResponse
    {
        $request->validate([
            'name' => 'unique:news',
        ]);

        try {
            $data = $request->safe()->except('image');

            if ($request->has('image')) {
                $data['image'] = $this->fileService->saveFile($request->file('image'), StorageType::News);
            }

            News::query()->create($data);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Response::redirectToRoute('admin.news.index')
                ->withErrors(['error' => __('admin.news_creation_error')]);
        }

        return Response::redirectToRoute('admin.news.index')
            ->with(['success' => __('admin.news_creation_success', ['name' => $request->post('name')])]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news): HttpResponse
    {
        $news->setAttribute('image', $this->fileService->getFileUrl($news->image ?? ''));

        return Response::view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsPostRequest $request, News $news): RedirectResponse
    {
        try {
            $updatedData = $request->safe()->except('image');
            $currentFile = $news->image;

            if ($request->has('image')) {
                $updatedData['image'] = $this->fileService
                    ->updateFile($request->file('image'), StorageType::News, $currentFile);
            } elseif (! $request->has('loadedImages')) {
                $this->fileService->deleteFile($currentFile);
                $updatedData['image'] = null;
            } else {
                $updatedData['image'] = $currentFile;
            }

            $news->update($updatedData);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Response::redirectToRoute('admin.news.index')
                ->withErrors(['error' => __('admin.news_update_error')]);
        }

        return Response::redirectToRoute('admin.news.index')
            ->with(['success' => __('admin.news_update_success', ['name' => $request->post('name')])]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news): RedirectResponse
    {
        try {
            DB::transaction(function () use ($news) {
                $news->deleteOrFail();
                $this->fileService->deleteFile($news->image ?? '');
            });
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return Response::redirectToRoute('admin.news.index')
                ->withErrors(['error' => __('admin.news_delete_error')]);
        }

        return Response::redirectToRoute('admin.news.index')
            ->with('success', __('admin.news_delete_success', ['name' => $news->name]));
    }
}
