@extends('layouts.admin')
@section('title', 'Просмотр вопроса')

@section('content')
    <div class="font-medium text-4xl mb-10 mx-auto text-center">
        <h2>Вопрос</h2>
    </div>

    <x-admin.show.show form-back-url="admin.questions.index" :model="$question">
        @if($question->user_id)
            <x-admin.show.data-url data-label="ID Пользователя" :data-value="$question->user_id" url="admin.users.show"
                                   :params="['user' => $question->user_id]"/>
        @endif
        <x-admin.show.data data-label="ФИО" :data-value="$question->full_name"/>
        <x-admin.show.data data-label="Email" :data-value="$question->email"/>
        <x-admin.show.data data-label="Вопрос" :data-value="$question->question_text"/>
        @if($question->is_closed)
            <x-admin.show.data data-label="Ответ" :data-value="$question->answer_text"/>
        @else
            <div
                class="px-5 pt-4 xl:pt-[27px] xl:min-h-[78px] rounded-t-lg xl:rounded-e-none xl:rounded-s-lg">
                <p>Ответ:</p>
            </div>
            <form method="POST" action="{{route('admin.questions.update', ['question' => $question])}}"
                  class="relative p-5 pt-1 xl:pt-6 rounded-b-lg xl:rounded-s-none xl:rounded-e-lg">
                @csrf
                @method('PUT')
                <textarea id="answer_text" name="answer_text" placeholder="Введите текст"
                          class="w-full 2xl:w-[650px] max-h-[650px] h-[300px] border border-lightgray rounded-[5px] p-4 overflow-auto resize-none">{{old('answer_text') ?: $question->answer_text}}</textarea>
                <x-admin.forms.input-error :error-name="'answer_text'"/>
                <x-admin.forms.submit submit-label="Ответить" class="block mt-2"/>
            </form>
        @endif
        <x-admin.show.data data-label="Дата создания" :data-value="$question->created_at"/>
    </x-admin.show.show>
@endsection
