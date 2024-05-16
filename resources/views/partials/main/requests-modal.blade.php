<div id="requestModal"
     class="mx-auto fixed inset-0 bg-black bg-opacity-20 items-center justify-center z-[9999] hidden transition-opacity duration-300">
    <div
        class="bg-white rounded-[5px] shadow-lg opacity-0 transform scale-95 transition-all duration-300 mx-4 w-[600px]">
        <div class="flex flex-row justify-between items-center px-5 py-4 border-b border-lightgray">
            <h3 class="font-medium text-xl">Заявочный лист</h3>
            <button id="requestModalClose">
                <img src="{{Vite::asset('resources/images/menu/close.svg')}}" alt="close" class="w-[18px]">
            </button>
        </div>

        @guest
            <form id="requestForm" method="POST" action="{{route('main.event.request')}}"
                  class="custom-scrollbar flex flex-col justify-between gap-4 py-5 px-5 sm:px-6 overflow-hidden h-fit max-h-[85vh]">
                @csrf
                <div id="requestFormMessage"
                     class="hidden text-error text-[14px] min-h-10 overflow-auto xl:min-h-0 xl:overflow-hidden"></div>
                <input type="hidden" name="event_id" value="{{$event->id}}">
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
                    <x-forms.input input-name="supervisor_full_name" input-label="ФИО руководителя"
                                   input-placeholder="Введите ФИО руководителя"
                                   :is-required="true"/>
                    <x-forms.input input-name="organization_name" input-label="Название организации"
                                   input-placeholder="Введите название организации"
                                   :is-required="true"/>
                    <x-forms.input input-name="team_name" input-label="Название коллектива"
                                   input-placeholder="Введите название коллектива"/>
                    <x-forms.date-input input-name="date_creation_team" input-label="Дата создания коллектива"
                                        input-placeholder="Введите дату создания коллектива"
                                        min-number="0"
                                        max-number="{{now()->toDateString()}}"/>
                    <x-forms.number-input input-name="participants_number" input-label="Кол-во прибывающих"
                                          input-placeholder="Введите кол-во прибывающих"
                                          min-number="0" max-number="500"/>
                </div>
                <x-forms.checkbox checkbox-name="request-personal-data">
                    Я согласен на обработку <a href="/" class="text-lightblue">персональных данных</a>
                </x-forms.checkbox>
                <x-forms.submit submit-label="Отправить" class="w-1/2"/>
            </form>
        @endguest

        @auth
            <form id="requestForm" method="POST" action="{{route('main.event.request')}}"
                  class="custom-scrollbar flex flex-col justify-between gap-4 py-5 px-5 sm:px-6 overflow-hidden h-fit max-h-[85vh]">
                @csrf
                <div id="requestFormMessage"
                     class="hidden text-error text-[14px] overflow-auto min-h-10 xl:min-h-0 xl:overflow-hidden"></div>
                <input type="hidden" name="event_id" value="{{$event->id}}">
                <div class="flex flex-col justify-between gap-4 overflow-auto px-1 pb-1">
                    @if(!$user->profile->phone)
                        <x-forms.input input-name="phone" input-label="Номер телефона" input-placeholder="Введите номер"
                                       :is-required="true"/>
                    @endif
                    @if(!$user->profile->date_of_birth)
                        <x-forms.date-input input-name="date_of_birth" input-label="Дата рождения"
                                            input-placeholder="Введите дату рождения"
                                            min-number="{{now()->subYears(100)->toDateString()}}"
                                            max-number="{{now()->toDateString()}}"
                                            :is-required="true"/>
                    @endif
                    @if(!$user->profile->address)
                        <x-forms.input input-name="address" input-label="Адрес" input-placeholder="Введите адрес"
                                       :is-required="true"/>
                    @endif
                    <x-forms.input input-name="supervisor_full_name" input-label="ФИО руководителя"
                                   input-placeholder="Введите ФИО руководителя"
                                   :is-required="true"/>
                    <x-forms.input input-name="organization_name" input-label="Название организации"
                                   input-placeholder="Введите название организации"
                                   :is-required="true"/>
                    <x-forms.input input-name="team_name" input-label="Название коллектива"
                                   input-placeholder="Введите название коллектива"/>
                    <x-forms.date-input input-name="date_creation_team" input-label="Дата создания коллектива"
                                        input-placeholder="Введите дату создания коллектива"
                                        min-number="0"
                                        max-number="{{now()->toDateString()}}"/>
                    <x-forms.number-input input-name="participants_number" input-label="Кол-во прибывающих"
                                          input-placeholder="Введите кол-во прибывающих"
                                          min-number="0" max-number="500"/>
                </div>
                <x-forms.submit submit-label="Отправить" class="w-1/2"/>
            </form>
        @endauth

    </div>
</div>