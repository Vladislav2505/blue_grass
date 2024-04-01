@extends('layouts.app')
@section('title', 'Регистрация')
@vite('resources/js/forms/registration.js')

@section('content')
    <x-forms.auth-form :form-action="'register'">
        <div class="text-center pb-6">
            <h2 class="text-4xl font-bold mb-1 sm:text-5xl">Регистрация</h2>
            <p class="text-secondary">У вас уже есть учетная запись? <a href="{{route('login')}}"
                                                                        class="text-lightblue">Войти</a>
            </p>
        </div>
        <div class="w-full flex flex-col gap-4">
            <x-forms.input input-name="last_name" input-label="Фамилия" input-placeholder="Введите Фамилию"/>
            <x-forms.input input-name="first_name" input-label="Имя" input-placeholder="Введите Имя"/>
            <x-forms.input input-name="email" input-label="E-mail" input-placeholder="Введите E-mail"/>
            <x-forms.input input-name="password" input-label="Пароль" input-placeholder="Введите Пароль"
                           input-type="password"/>
            <x-forms.input input-name="password_confirmation" input-label="Подтверждения пароля"
                           input-placeholder="Подтвердите пароль" input-type="password"/>
            <x-forms.checkbox checkbox-name="personal-data">
                Я согласен на обработку <a href="/" class="text-lightblue">персональных данных</a>
            </x-forms.checkbox>
            <x-forms.submit submit-label="Зарегистрироваться"/>
        </div>
    </x-forms.auth-form>
@endsection
