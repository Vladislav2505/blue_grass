@extends('layouts.main')
@section('title', 'Безопасность')

@section('content')
    <div class="flex flex-col gap-3">
        <a href="{{route('profile.dashboard')}}" class="flex flex-row items-center text-lightblue text-xl w-fit gap-1">
            <img src="{{Vite::asset('resources/images/profile/back.svg')}}" alt="back">
            Назад
        </a>
        <h2 class="text-center font-medium text-3xl">Безопасность</h2>
    </div>

    <form class="flex flex-col" method="POST" action="{{route('profile.security.reset')}}">
        @method('POST')
        @csrf

        <div class="grid grid-cols-1 xl:grid-cols-[minmax(200px,420px)_auto]">
            <x-admin.forms.text-input input-name="current_password" input-label="Текущий пароль" :is-required="true" input-type="password"/>
            <x-admin.forms.text-input input-name="password" input-label="Новый пароль" :is-required="true" input-type="password"/>
            <x-admin.forms.text-input input-name="password_confirmation" input-label="Подтверждение пароля" input-type="password"/>
        </div>
        <div class="flex flex-row justify-end gap-3">
            <x-forms.submit submit-label="Сохранить" class="px-4"/>
        </div>
    </form>

@endsection
