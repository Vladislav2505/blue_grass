@extends('layouts.auth')
@section('title', 'Регистрация')

@php
    $formLabel = 'У вас уже есть учетная запись? <a href="' . route('login.render') . '" class="text-lightblue">Войти</a>';
@endphp

@section('content')
    <x-forms.auth-form form-action="register" form-title="Регистрация" :form-label="$formLabel">
        @if($errors->first('error'))
            <p class="text-error font-bold text-center">{{$errors->first('error')}}</p>
        @endif
        <x-forms.input input-name="last_name" input-label="Фамилия" input-placeholder="Введите Фамилию"
                       :input-value="old('last_name')"/>
        <x-forms.input input-name="first_name" input-label="Имя" input-placeholder="Введите Имя"
                       :input-value="old('first_name')"/>
        <x-forms.input input-name="email" input-label="E-mail" input-placeholder="Введите E-mail"
                       :input-value="old('email')"/>
        <x-forms.input input-name="password" input-label="Пароль" input-placeholder="Введите Пароль"
                       input-type="password" :input-value="old('password')"/>
        <x-forms.input input-name="password_confirmation" input-label="Подтверждения пароля"
                       input-placeholder="Подтвердите пароль" input-type="password"/>
        <x-forms.checkbox checkbox-name="personal-data">
            Я согласен на обработку <a href="/" class="text-lightblue">персональных данных</a>
        </x-forms.checkbox>
        <x-forms.submit submit-label="Зарегистрироваться"/>
    </x-forms.auth-form>
@endsection
