<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

final class EventDetailController extends Controller
{
    public function show(Event $event): HttpResponse
    {
        return Response::view('main.event-detail', compact('event'));
    }
}
