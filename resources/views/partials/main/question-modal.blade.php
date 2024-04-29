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
              class="flex flex-col justify-between gap-4 py-5 px-6 sm:px-7">
            @csrf
            <div id="questionFormMessage" class="hidden text-error text-[14px]"></div>
            @guest
                <x-forms.input input-name="full_name" input-label="ФИО" input-placeholder="Введите ФИО"
                               :is-required="true"/>
                <x-forms.input input-name="email" input-label="Email" input-placeholder="Введите Email"
                               :is-required="true"/>
            @endguest
            <x-forms.textarea textarea-name="question_text" textarea-label="Вопрос" :is-required="true"/>
            @guest
                <x-forms.checkbox checkbox-name="question-personal-data">
                    Я согласен на обработку <a href="/" class="text-lightblue">персональных данных</a>
                </x-forms.checkbox>
            @endguest
            <x-forms.submit submit-label="Отправить" class="w-1/2"/>
        </form>
    </div>
</div>
