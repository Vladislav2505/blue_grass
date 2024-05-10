<div id="requestModal"
     class="mx-auto fixed inset-0 bg-black bg-opacity-20 items-center justify-center z-[9999] hidden transition-opacity duration-300">
    <div
        class="mx-4 bg-white rounded-[5px] shadow-lg w-[600px] opacity-0 transform scale-95 transition-all duration-300">
        <div class="flex flex-row justify-between items-center px-5 py-4 border-b border-lightgray">
            <h3 class="font-medium text-xl">Оставить заявку</h3>
            <button id="requestModalClose">
                <img src="{{Vite::asset('resources/images/menu/close.svg')}}" alt="close" class="w-[18px]">
            </button>
        </div>

        @guest
            <form id="requestForm" method="POST" action="{{route('main.question')}}"
                  class="custom-scrollbar flex flex-col justify-between gap-4 py-5 px-5 sm:px-6 overflow-hidden h-fit max-h-[85vh]">
                @csrf
                <div id="requestFormMessage" class="hidden text-error text-[14px]"></div>
                <div class="flex flex-col justify-between gap-4 overflow-auto px-1 pb-1">
                    <x-forms.input input-name="full_name" input-label="ФИО" input-placeholder="Введите ФИО"
                                   :is-required="true"/>
                    <x-forms.input input-name="email" input-label="Email" input-placeholder="Введите Email"
                                   :is-required="true"/>
                    <x-forms.input input-name="phone" input-label="Номер телефона" input-placeholder="Введите номер"
                                   :is-required="true"/>
                    <x-forms.date-input input-name="date_of_birth" input-label="Дата рождения"
                                        input-placeholder="Введите дату рождения"
                                        min-number="{{now()->subYears(100)->toDateString()}}"
                                        max-number="{{now()->toDateString()}}"
                                        :is-required="true"/>
                    <x-forms.input input-name="address" input-label="Адрес" input-placeholder="Введите адрес"
                                   :is-required="true"/>
                    <x-forms.input input-name="team_name" input-label="Название коллектива"
                                   input-placeholder="Введите название коллектива"
                                   :is-required="true"/>
                    <x-forms.input input-name="supervisor_full_name" input-label="ФИО руководителя"
                                   input-placeholder="Введите ФИО руководителя"
                                   :is-required="true"/>
                    <x-forms.input input-name="organization_name" input-label="Название организации"
                                   input-placeholder="Введите название организации"
                                   :is-required="true"/>
                    <x-forms.date-input input-name="date_of_birth" input-label="Дата создания коллектива"
                                        input-placeholder="Введите дату создания коллектива"
                                        max-number="{{now()->toDateString()}}"
                                        :is-required="true"/>
                    <x-forms.number-input input-name="participants_number" input-label="Кол-во прибывающих"
                                          input-placeholder="Введите кол-во прибывающих"
                                          min-number="0" max-number="500"/>
                </div>
                <x-forms.checkbox checkbox-name="question-personal-data">
                    Я согласен на обработку <a href="/" class="text-lightblue">персональных данных</a>
                </x-forms.checkbox>
                <x-forms.submit submit-label="Отправить" class="w-1/2"/>
            </form>
        @endguest

    </div>
</div>
