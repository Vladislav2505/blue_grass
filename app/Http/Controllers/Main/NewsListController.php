<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Services\FileService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Throwable;

final class NewsListController extends Controller
{
    protected readonly int $newsPerPage;

    public function __construct()
    {
        $this->newsPerPage = 3;
    }

    /**
     * @throws Throwable
     */
    public function show(Request $request)
    {
        $newsList = News::query()
            ->where('is_active', true)
            ->orderByDesc('updated_at')
            ->paginate($this->newsPerPage);

        if ($request->ajax()) {
            return Response::json([
                'content' => view('partials.main.lists.news-list', compact('newsList'))->render(),
                'next' => $newsList->hasMorePages(),
            ]);
        }

        return Response::view('main.news', compact('newsList'));
    }
}
