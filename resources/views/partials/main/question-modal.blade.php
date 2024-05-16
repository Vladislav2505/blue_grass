<div id="questionModal"
     class="mx-auto fixed inset-0 bg-black bg-opacity-20 items-center justify-center z-[9999] hidden transition-opacity duration-300">
    <div class="mx-4 bg-white rounded-[5px] shadow-lg w-96 opacity-0 transform scale-95 transition-all duration-300">
        <div class="flex flex-row justify-between items-center px-5 py-4 border-b border-lightgray">
            <h3 class="font-medium text-xl">Задать вопрос</h3>
            <button id="questionModalClose">
                <img src="{{Vite::asset('resources/images/menu/close.svg')}}" alt="close" class="w-[18px]">
            </button>
        </div>

        <form id="questionForm" method="POST" action="{{route('main.question')}}"
              class="custom-scrollbar flex flex-col justify-between gap-4 py-5 px-5 sm:px-6 overflow-hidden h-fit max-h-[85vh]">
            @csrf
            <div id="questionFormMessage"
                 class="hidden text-error text-[14px] overflow-auto min-h-10 xl:min-h-0 xl:overflow-hidden"></div>
            <div class="flex flex-col justify-between gap-4 overflow-auto pr-1 pb-1">
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
            @guest
                <x-forms.checkbox checkbox-name="question-personal-data">
                    Я согласен на обработку <a href="/" class="text-lightblue">персональных данных</a>
                </x-forms.checkbox>
            @endguest
            <x-forms.submit submit-label="Отправить" class="w-1/2"/>
        </form>
    </div>
</div>
