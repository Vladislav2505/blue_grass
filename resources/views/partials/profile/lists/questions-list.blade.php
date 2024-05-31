@foreach($questions as $question)
    <article class="flex flex-col gap-3 border border-lightgray rounded-[5px] w-full md:w-[90%] p-5 shadow">
        <div>
            <h3 class="text-xl mb-1">
                Вопрос “<span class="font-medium">{{$question->question_title}}”</span>
            </h3>
            <p class="text-secondary text-[14px] text-right sm:text-left">{{$question->updated_at}}</p>
        </div>
        <p class="font-light break-words">
            {{$question->answer_text ?? "Администратор еще не ответил на этот вопрос"}}
        </p>
    </article>
@endforeach
