@extends('layouts.app')
@section('title', 'Авторизация')
@vite('resources/js/forms/auth.js')

@section('content')
    <x-forms.auth-form :form-action="'login'">
        <div class="text-center pb-6">
            <h2 class="text-4xl font-bold mb-1 sm:text-5xl">Авторизация</h2>
            <p class="text-secondary">У вас нет учетной записи?
                <a href="{{route('register')}}" class="text-lightblue">Регистрация</a>
            </p>
        </div>
        <div class="w-full flex flex-col gap-4">
            <x-forms.input input-name="email" input-label="E-mail" input-placeholder="Введите E-mail"/>
            <x-forms.input input-name="password" input-label="Пароль" input-placeholder="Введите Пароль"/>
            <div class="flex justify-between">
                <div class="flex">
                    <input type="checkbox" class="w-5 rounded-[5px] cursor-pointer" id="remember-me"
                           name="remember-me">
                    <label for="remember-me" class="text-[14px] ml-2">Запомнить меня</label>
                </div>
                <a href="/" class="text-lightblue text-[12px] xs:text-[14px]">Забыли пароль?</a>
            </div>
            <x-forms.submit submit-label="Войти"/>
        </div>
    </x-forms.auth-form>
@endsection
