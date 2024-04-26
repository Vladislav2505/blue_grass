@extends('layouts.admin')
@section('title', 'Редактирование пользователя')

@section('content')
    <div class="font-medium text-4xl mb-10 mx-auto text-center">
        <h2>Редактирование пользователя</h2>
    </div>

    <x-admin.forms.form form-action="admin.users.update" :form-action-param="['user' => $user]"
                        form-back-url="admin.users.index" form-method="PUT">
        <x-admin.forms.text-input input-name="last_name" input-label="Фамилия" :input-value="$user->last_name" :is-required="true"/>
        <x-admin.forms.text-input input-name="first_name" input-label="Имя" :input-value="$user->first_name" :is-required="true"/>
        <x-admin.forms.text-input input-name="patronymic" input-label="Отчество" :input-value="$user->patronymic"/>
        <x-admin.forms.text-input input-name="email" input-label="Email" :input-value="$user->email" :is-required="true"/>
    </x-admin.forms.form>
@endsection
