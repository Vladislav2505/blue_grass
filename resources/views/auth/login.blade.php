@extends('layouts.auth')
@section('title', 'Авторизация')

@php
    $formLabel = 'У вас нет учетной записи? <a href="' . route('register') . '" class="text-lightblue">Регистрация</a>'
@endphp

@section('content')
    <x-forms.auth-form form-action="login" form-title="Авторизация" :form-label="$formLabel">
        @if(session('status'))
            <p class="text-success font-bold text-center">{{session('status')}}</p>
        @endif
        <x-forms.input input-name="email" input-label="E-mail" input-placeholder="Введите E-mail" input-type="email" :input-value="old('email')"/>
        <x-forms.input input-name="password" input-label="Пароль" input-placeholder="Введите Пароль"
                       input-type="password" :input-value="old('password')"/>
        <div class="flex justify-between">
            <div class="flex">
                <input type="checkbox" class="w-5 rounded-[5px] cursor-pointer" id="remember-me"
                       name="remember-me">
                <label for="remember-me" class="text-[14px] ml-2">Запомнить меня</label>
            </div>
            <a href="{{route('forgot-password')}}" class="text-lightblue text-[12px] xs:text-[14px]">Забыли пароль?</a>
        </div>
        <x-forms.submit submit-label="Войти"/>
    </x-forms.auth-form>
@endsection
