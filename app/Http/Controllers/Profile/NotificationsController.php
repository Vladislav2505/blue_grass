<?php

namespace App\Http\Controllers\Profile;

use App\Enums\RequestStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Throwable;

final class NotificationsController extends Controller
{
    protected readonly int $notificationsPerPage;

    public function __construct()
    {
        $this->notificationsPerPage = 10;
    }

    /**
     * @throws Throwable
     */
    public function requests(Request $request): JsonResponse|HttpResponse
    {
        $requests = Auth::user()?->requests()
            ->where('status', '!=', RequestStatus::Pending)
            ->orderByDesc('updated_at')
            ->with('event:id,name')
            ->paginate($this->notificationsPerPage);

        if ($request->ajax()) {
            return Response::json([
                'content' => view('partials.profile.lists.requests-list', compact('requests'))->render(),
                'next' => $requests->hasMorePages(),
            ]);
        }

        return Response::view('profile.notifications.requests', compact('requests'));
    }

    /**
     * @throws Throwable
     */
    public function questions(Request $request): JsonResponse|HttpResponse
    {
        $questions = Auth::user()?->questions()
            ->orderByDesc('is_closed')
            ->orderByDesc('updated_at')
            ->paginate($this->notificationsPerPage);

        if ($request->ajax()) {
            return Response::json([
                'content' => view('partials.profile.lists.questions-list', compact('questions'))->render(),
                'next' => $questions->hasMorePages(),
            ]);
        }

        return Response::view('profile.notifications.questions', compact('questions'));
    }
}
