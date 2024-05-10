@extends('layouts.main')
@section('title', 'Редактирование профиля')

@section('content')
    <div class="flex flex-col gap-3">
        <a href="{{route('profile.dashboard')}}" class="flex flex-row items-center text-lightblue text-xl w-fit gap-1">
            <img src="{{Vite::asset('resources/images/profile/back.svg')}}" alt="back">
            Назад
        </a>
        <h2 class="text-center font-medium text-3xl">Редактирование профиля</h2>
    </div>

    <form class="flex flex-col" method="POST" action="{{route('profile.update')}}">
        @method('PUT')
        @csrf

        <div class="grid grid-cols-1 xl:grid-cols-[minmax(200px,420px)_auto]">
            <x-admin.forms.text-input input-name="last_name" input-label="Фамилия" :input-value="$user->profile->last_name" :is-required="true"/>
            <x-admin.forms.text-input input-name="first_name" input-label="Имя" :input-value="$user->profile->first_name" :is-required="true"/>
            <x-admin.forms.text-input input-name="patronymic" input-label="Отчество" :input-value="$user->profile?->patronymic"/>
            <x-admin.forms.text-input input-name="phone" input-label="Телефон" :input-value="$user->profile?->phone" input-placeholder="+7" class="md:w-60"/>
            <x-admin.forms.date-input input-name="date_of_birth" input-label="Дата рождения" :input-value="$user->profile?->date_of_birth" input-type="number" min-number="{{now()->subYears(100)->toDateString()}}" max-number="{{now()->toDateString()}}"/>
            <x-admin.forms.text-input input-name="address" input-label="Адрес" :input-value="$user->profile?->address"/>
            <x-admin.forms.checkbox-input input-name="subscribed_to_notifications" input-label="Получать письма на почту" :input-is-checked="$user->subscribed_to_notifications"/>
        </div>
        <div class="flex flex-row justify-end gap-3">
            <x-forms.submit submit-label="Сохранить" class="px-4"/>
        </div>
    </form>

@endsection
