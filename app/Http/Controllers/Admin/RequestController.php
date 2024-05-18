<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RequestStatus;
use App\Http\Controllers\Controller;
use App\Jobs\SendNotification;
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
    public function index(): HttpResponse
    {
        $tableHeaders = ['ID', 'Мероприятие', 'ФИО', 'Email', 'Телефон', 'Дата рождения', 'Кол-во участников', 'Дата заявки', 'Статус'];

        $requests = Request::query()
            ->orderBy('status')
            ->orderByDesc('created_at')
            ->with('event:id,name')
            ->paginate(self::PER_PAGE);

        return Response::view('admin.requests.index', compact('requests', 'tableHeaders'));
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
