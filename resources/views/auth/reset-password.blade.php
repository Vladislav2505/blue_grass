@extends('layouts.auth')
@section('title', 'Сброс пароля')

@section('content')
    <x-forms.auth-form form-action="password.reset" form-title="Сброс пароля">
        <x-forms.input input-name="email" input-label="E-mail" input-placeholder="Введите E-mail"
                       input-type="email"/>
        <x-forms.input input-name="password" input-label="Пароль" input-placeholder="Введите Новый Пароль"
                       input-type="password"/>
        <x-forms.input input-name="password_confirmation" input-label="Подтверждения пароля"
                       input-placeholder="Подтвердите пароль" input-type="password"/>
        <x-forms.submit submit-label="Сбросить пароль"/>
    </x-forms.auth-form>
@endsection
