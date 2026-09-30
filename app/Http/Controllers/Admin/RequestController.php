<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RequestStatus;
use App\Http\Controllers\Controller;
use App\Jobs\SendNotification;
use App\Models\Event;
use App\Models\Request;
use App\Models\User;
use App\Notifications\SendRequestSolutionNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Throwable;

final class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(HttpRequest $httpRequest): HttpResponse
    {
        $tableHeaders = ['ID', 'Мероприятие', 'ФИО', 'Email', 'Телефон', 'Дата рождения', 'Кол-во участников', 'Дата заявки', 'Статус'];

        $filters = $httpRequest->validate([
            'id' => ['nullable', 'integer', 'min:1'],
            'event_id' => ['nullable', 'integer', 'exists:events,id'],
            'full_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'date_of_birth' => ['nullable', 'date'],
            'participants_number' => ['nullable', 'integer', 'min:0'],
            'created_at' => ['nullable', 'date'],
            'status' => ['nullable', 'integer', 'in:0,1,2'],
        ]);

        $events = Event::query()->orderBy('name')->get(['id', 'name']);

        $requests = Request::query()
            ->when(isset($filters['id']), fn ($query) => $query->whereKey($filters['id']))
            ->when(isset($filters['event_id']), fn ($query) => $query->where('event_id', $filters['event_id']))
            ->when(isset($filters['full_name']), fn ($query) => $query->where('full_name', 'like', '%'.$filters['full_name'].'%'))
            ->when(isset($filters['email']), fn ($query) => $query->where('email', 'like', '%'.$filters['email'].'%'))
            ->when(isset($filters['phone']), fn ($query) => $query->where('phone', 'like', '%'.$filters['phone'].'%'))
            ->when(isset($filters['date_of_birth']), fn ($query) => $query->whereDate('date_of_birth', $filters['date_of_birth']))
            ->when(isset($filters['participants_number']), fn ($query) => $query->where('participants_number', $filters['participants_number']))
            ->when(isset($filters['created_at']), fn ($query) => $query->whereDate('created_at', $filters['created_at']))
            ->when(isset($filters['status']), fn ($query) => $query->where('status', $filters['status']))
            ->orderByDesc('id')
            ->with('event:id,name')
            ->paginate(self::PER_PAGE)
            ->withQueryString();

        return Response::view('admin.requests.index', compact('requests', 'tableHeaders', 'events', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HttpRequest $httpRequest): void
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request): HttpResponse
    {
        $request->load(['event:id,name']);

        return Response::view('admin.requests.show', compact('request'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): void
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @throws Throwable
     */
    public function update(HttpRequest $httpRequest, Request $request): RedirectResponse
    {
        if ($httpRequest->has(RequestStatus::Accepted->name)) {
            $request->status = RequestStatus::Accepted;
        } elseif ($httpRequest->has(RequestStatus::Rejected->name)) {
            $request->status = RequestStatus::Rejected;
        }

        $request->saveOrFail();

        if ($request->user_id) {
            /** @var User $user */
            $user = User::query()->find($request->user_id);
            SendNotification::dispatch(
                user: $user,
                notification: new SendRequestSolutionNotification($request)
            )->afterResponse();
        } else {
            SendNotification::dispatch(
                email: $request->email,
                notification: new SendRequestSolutionNotification($request)
            )->afterResponse();
        }

        return Response::redirectToRoute('admin.requests.show', ['request' => $request]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): RedirectResponse
    {
        try {
            $request->deleteOrFail();
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return Response::redirectToRoute('admin.requests.index')
                ->withErrors(['error' => __('admin.request_delete_error')]);
        }

        return Response::redirectToRoute('admin.requests.index')
            ->with(['success' => __('admin.request_delete_success')]);
    }
}
