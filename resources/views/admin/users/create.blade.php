@extends('layouts.admin')
@section('title', 'Создание пользователя')

@section('content')
    <div class="font-medium text-4xl mb-10 mx-auto text-center">
        <h2>Создание пользователя</h2>
    </div>

    <x-admin.forms.form form-action="admin.users.store"
                        form-back-url="admin.users.index">
        <x-admin.forms.text-input input-placeholder="Введите фамилию" input-name="last_name" input-label="Фамилия" :is-required="true"/>
        <x-admin.forms.text-input input-name="first_name" input-label="Имя" :is-required="true"/>
        <x-admin.forms.text-input input-name="patronymic" input-label="Отчество"/>
        <x-admin.forms.text-input input-type="email" input-name="email" input-label="Email" :is-required="true"/>
        <x-admin.forms.text-input input-type="password" input-name="password" input-label="Пароль" :is-required="true"/>
        <x-admin.forms.checkbox-input input-name="is_admin" input-label="Администратор"/>
    </x-admin.forms.form>
@endsection
