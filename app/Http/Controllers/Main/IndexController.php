<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Protocol;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;
use Throwable;

final class IndexController extends Controller
{
    protected readonly int $eventsPerPage;

    protected readonly int $protocolsPerPage;

    public function __construct()
    {
        $this->eventsPerPage = 8;
        $this->protocolsPerPage = 6;
    }

    /**
     * @throws Throwable
     */
    public function events(Request $request): JsonResponse|HttpResponse
    {
        $events = Event::query()
            ->where('is_active', true)
            ->with(['location:id,name'])
            ->orderByDesc('date_of')
            ->orderByDesc('request_access')
            ->paginate($this->eventsPerPage);

        if ($request->ajax()) {
            return Response::json([
                'content' => view('partials.main.lists.event-list', compact('events'))->render(),
                'next' => $events->hasMorePages(),
            ]);
        }

        $meta = [
            'description' => __('meta.index_events.description'),
            'keywords' => __('meta.index_events.keywords'),
        ];

        return Response::view('main.index.events', compact('events', 'meta'));
    }

    /**
     * @throws Throwable
     */
    public function protocols(Request $request): JsonResponse|HttpResponse
    {
        $protocols = Protocol::query()
            ->where('is_active', true)
            ->orderByDesc('date')
            ->paginate($this->protocolsPerPage);

        if ($request->ajax()) {
            return Response::json([
                'content' => view('partials.main.lists.protocol-list', compact('protocols'))->render(),
                'next' => $protocols->hasMorePages(),
            ]);
        }

        $meta = [
            'description' => __('meta.index_protocols.description'),
            'keywords' => __('meta.index_protocols.keywords'),
        ];

        return Response::view('main.index.protocols', compact('protocols', 'meta'));
    }
}
