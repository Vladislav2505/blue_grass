<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Jobs\SendNotification;
use App\Models\Event;
use App\Models\Request;
use App\Models\User;
use App\Notifications\SendRequestNotification;
use App\Rules\RecaptchaRule;
use Auth;
use Durlecode\EJSParser\Parser;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

final class EventDetailController extends Controller
{
    public function show(Event $event): HttpResponse
    {
        $user = Auth::user();
        $event->load(['theme:id,name', 'location:id,name', 'nominations:id,name']);
        $event->description = Parser::parse($event->description)->getBlocks();

        if ($user) {
            $sendRequest = $user->whereRelation('requests', 'event_id', '=', $event->id)->exists();
            $user->setAttribute('send_request', $sendRequest);
        }

        return Response::view('main.event-detail', compact('event', 'user'));
    }

    public function request(HttpRequest $request): JsonResponse
    {
        $rules = [];
        /** @var Event $event */
        $event = Event::query()->findOrFail($request->post('event_id'));

        if (Auth::check()) {
            /** @var User $user */
            $user = Auth::user();

            if ($user->whereRelation('requests', 'event_id', '=', $event->id)->exists()) {
                return Response::json(['error' => __('main.request_exists')], 500);
            }

            $request->merge([
                'full_name' => $user->profile->full_name,
                'email' => $user->email,
                'phone' => $request->has('phone') ? $request->post('phone') : $user->profile->phone,
                'date_of_birth' => $request->has('date_of_birth') ? $request->post('date_of_birth') : $user->profile->date_of_birth,
                'address' => $request->has('address') ? $request->post('address') : $user->profile->address,
                'user_id' => $user->id,
            ]);
        } else {
            $rules = [
                'g-recaptcha-response' => ['required', new RecaptchaRule()],
            ];
        }

        $data = $request->validate([
            'event_id' => ['required', 'integer', 'exists:events,id'],
            'user_id' => ['sometimes', 'integer', 'exists:users,id'],
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:rfc,dns', 'max:80'],
            'phone' => ['required', 'string', 'regex:/^\+\d{11}$/'],
            'date_of_birth' => ['required', 'date_format:Y-m-d', 'before_or_equal:today'],
            'address' => ['required', 'string', 'max:255'],
            'supervisor_full_name' => ['required', 'string', 'max:255'],
            'organization_name' => ['required', 'string', 'max:255'],
            'team_name' => ['nullable', 'string', 'max:255'],
            'date_creation_team' => ['nullable', 'date_format:Y-m-d', 'before_or_equal:today'],
            'participants_number' => ['nullable', 'integer', 'min:0'],
            ...$rules,
        ]);

        try {
            /** @var Request $userRequest */
            $userRequest = Request::query()->updateOrCreate(['id' => $data['user_id'] ?? null], $data);

            SendNotification::dispatch(
                email: config('site.email'),
                notification: new SendRequestNotification($userRequest)
            )->afterResponse();
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Response::json(['error' => __('main.request_send_error')], 500);
        }

        return Response::json(['success' => __('main.request_send_success')]);
    }
}
