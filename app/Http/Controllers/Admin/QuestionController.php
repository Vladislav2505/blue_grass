<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendNotification;
use App\Models\Question;
use App\Notifications\SendQuestionAnswerNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Throwable;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): HttpResponse
    {
        $tableHeaders = ['ID', 'ФИО', 'Email', 'Дата создания', 'Отвечен'];

        $questions = Question::query()
            ->orderByDesc('created_at')
            ->orderBy('is_closed')
            ->paginate(self::PER_PAGE);

        return Response::view('admin.questions.index', compact('questions', 'tableHeaders'));
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
    public function store(Request $request): void
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question): HttpResponse
    {
        return Response::view('admin.questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question): void
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @throws Throwable
     */
    public function update(Request $request, Question $question): RedirectResponse
    {
        $validated = $request->validate([
            'answer_text' => ['required', 'string', 'max:1500'],
        ]);

        $validated['is_closed'] = true;

        $question->updateOrFail($validated);

        SendNotification::dispatch(
            email: $question->email,
            notification: new SendQuestionAnswerNotification($question)
        )->afterResponse();

        return Response::redirectToRoute('admin.questions.index')
            ->with(['success' => __('admin.question_send_success')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question): RedirectResponse
    {
        try {
            $question->deleteOrFail();
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return Response::redirectToRoute('admin.questions.index')
                ->withErrors(['error' => __('admin.question_delete_error')]);
        }

        return Response::redirectToRoute('admin.questions.index')
            ->with(['success' => __('admin.question_delete_success')]);
    }
}
