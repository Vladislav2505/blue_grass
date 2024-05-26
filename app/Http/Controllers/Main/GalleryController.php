<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Throwable;

final class GalleryController extends Controller
{
    protected readonly int $collectionsPerPage;

    public function __construct()
    {
        $this->collectionsPerPage = 3;
    }

    /**
     * @throws Throwable
     */
    public function show(Request $request, FileService $fileService)
    {
        $collections = Collection::query()
            ->where('is_active', true)
            ->orderByDesc('updated_at')
            ->paginate($this->collectionsPerPage)
            ->through(function ($collection) use ($fileService) {
                $collection->images = collect($collection->images)
                    ->filter(function ($path) use ($fileService) {
                        return $fileService->checkFile($path);
                    });

                return $collection;
            });

        if ($request->ajax()) {
            return Response::json([
                'content' => view('partials.main.lists.collection-list', compact('collections'))->render(),
                'next' => $collections->hasMorePages(),
            ]);
        }

        $meta = [
            'description' => __('meta.gallery.description'),
            'keywords' => __('meta.gallery.keywords'),
        ];

        return Response::view('main.gallery', compact('collections', 'meta'));
    }
}
