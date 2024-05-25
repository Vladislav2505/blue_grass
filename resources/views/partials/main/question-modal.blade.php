<x-main.modal-wrapper modalId="questionModal" title="Задать вопрос">
    <form id="questionForm" method="POST" action="{{route('main.question')}}"
          class="invisible-scrollbar flex flex-col justify-between gap-4 py-5 px-5 sm:px-6 overflow-hidden h-full max-h-full">
        @csrf
        <div class="flex flex-col gap-2 overflow-hidden">
            <div id="questionFormMessage"
                 class="hidden text-error text-[12px] overflow-auto"></div>
            <div class="flex flex-col justify-between gap-4 overflow-auto">
                @guest
                    <x-forms.input input-name="full_name" input-label="ФИО" input-placeholder="Введите ФИО"
                                   :is-required="true"/>
                    <x-forms.input input-name="email" input-label="Email" input-placeholder="Введите Email"
                                   :is-required="true"/>
                @endguest
                <x-forms.input input-name="question_title" input-label="Тема вопроса" input-placeholder="Введите тему"
                               :is-required="true"/>
                <x-forms.textarea textarea-name="question_text" textarea-label="Вопрос" :is-required="true"/>
            </div>
        </div>
        <div class="flex flex-col gap-3">
            <x-main.recaptcha class=""/>
            @guest
                <x-forms.checkbox checkbox-name="question-personal-data">
                    Я согласен на обработку <a href="{{route('main.policy')}}" class="text-lightblue">персональных
                        данных</a>
                </x-forms.checkbox>
            @endguest
            <x-forms.submit submit-label="Отправить" class="w-1/2"/>
        </div>
    </form>
</x-main.modal-wrapper>
