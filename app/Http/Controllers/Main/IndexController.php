<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Event;
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
            ->orderByDesc('request_access')
            ->orderByDesc('date_of')
            ->paginate($this->eventsPerPage);

        if ($request->ajax()) {
            return Response::json([
                'content' => view('main.lists.event-list', compact('events'))->render(),
                'next' => $events->hasMorePages(),
            ]);
        }

        return Response::view('main.events', compact('events'));
    }
}
