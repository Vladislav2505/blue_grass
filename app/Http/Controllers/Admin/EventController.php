<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

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
            ->paginate(self::PER_PAGE);

        return Response::view('admin.events.index', compact('events', 'tableHeaders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event): HttpResponse
    {

        return Response::view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event): RedirectResponse
    {
        $event->delete();

        return Response::redirectToRoute('admin.events.index');
    }
}
