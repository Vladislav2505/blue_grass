<x-main.modal-wrapper modalId="requestModal" title="Заявочный лист">
    @guest
        <form id="requestForm" method="POST" action="{{route('main.event.request')}}"
              class="invisible-scrollbar flex flex-col justify-between gap-4 py-5 px-5 sm:px-6 overflow-hidden h-full max-h-full">
            @csrf
            <div class="flex flex-col gap-2 overflow-hidden h-[600px]">
                <input type="hidden" name="event_id" value="{{$event->id}}">
                <div class="flex flex-col justify-between gap-3 overflow-auto">
                    <x-forms.input input-name="full_name" input-label="ФИО" input-placeholder="Введите ФИО"
                                   :is-required="true"/>
                    <x-forms.input input-name="email" input-label="Email" input-placeholder="Введите Email"
                                   :is-required="true"/>
                    <x-forms.input input-name="phone" input-type="tel" input-label="Номер телефона"  input-placeholder="+7 (___) ___-__-__"
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
            </div>
            <div class="flex flex-col gap-3">
                <x-main.recaptcha recaptcha-id="requestRecaptcha"/>
                <x-forms.checkbox checkbox-name="request-personal-data">
                    Я согласен с условиями <a href="{{route('main.policy')}}" class="text-lightblue"> политики
                        конфиденциальности</a>
                </x-forms.checkbox>
                <x-forms.submit submit-label="Отправить"/>
            </div>
        </form>
    @endguest

    @auth
        <form id="requestForm" method="POST" action="{{route('main.event.request')}}"
              class="invisible-scrollbar flex flex-col justify-between gap-3 py-5 px-5 sm:px-6 overflow-hidden h-full max-h-full">
            @csrf
            <div class="flex flex-col gap-2 overflow-hidden">
                <input type="hidden" name="event_id" value="{{$event->id}}">
                <div class="flex flex-col justify-between gap-4 overflow-auto">
                    @if(!$user->profile->phone)
                        <x-forms.input input-name="phone" input-type="tel" input-label="Номер телефона" input-placeholder="+7 (___) ___-__-__"
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
            </div>
            <x-forms.submit submit-label="Отправить" class="w-1/2"/>
        </form>
    @endauth
    <div id="requestSuccess" class="hidden m-auto text-xl text-center p-5 text-success"></div>
</x-main.modal-wrapper>
