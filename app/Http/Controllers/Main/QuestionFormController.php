<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Jobs\SendNotification;
use App\Models\Question;
use App\Notifications\SendQuestionNotification;
use App\Rules\RecaptchaRule;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

final class QuestionFormController extends Controller
{
    public function send(Request $request): JsonResponse
    {
        $user = Auth::user();
        if ($user) {
            $data = $request->validate([
                'question_title' => ['required', 'string', 'max:255'],
                'question_text' => ['required', 'string', 'max:1000'],
            ]);

            $data['full_name'] = $user->profile->full_name;
            $data['email'] = $user->email;
            $data['user_id'] = $user->id;
        } else {
            $data = $request->validate([
                'full_name' => ['required', 'string', 'max:180'],
                'email' => ['required', 'email:rfc,dns', 'max:80'],
                'question_title' => ['required', 'string', 'max:255'],
                'question_text' => ['required', 'string', 'max:1000'],
                'g-recaptcha-response' => ['required', new RecaptchaRule()],
            ]);
        }

        try {
            $question = Question::query()->create($data);

            SendNotification::dispatch(
                email: config('site.email'),
                notification: new SendQuestionNotification($question)
            )->afterResponse();
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Response::json(['error' => __('main.question_send_error')], 500);
        }

        return Response::json(['success' => __('main.question_send_success')]);
    }
}
