<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Durlecode\EJSParser\Parser;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

final class EventDetailController extends Controller
{
    public function show(Event $event): HttpResponse
    {
        $event->load(['theme:id,name', 'location:id,name', 'nominations:id,name']);
        $event->description = Parser::parse($event->description)->getBlocks();
//        dd($event->description);
        return Response::view('main.event-detail', compact('event'));
    }
}
