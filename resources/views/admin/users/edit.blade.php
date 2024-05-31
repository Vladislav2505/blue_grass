@extends('layouts.admin')
@section('title', 'Редактирование пользователя')

@section('content')
    <div class="font-medium text-4xl mb-10 mx-auto text-center">
        <h2>Редактирование пользователя</h2>
    </div>

    <x-admin.forms.form form-action="admin.users.update" :form-action-param="['user' => $user]"
                        form-back-url="admin.users.index" form-method="PUT">
        <x-admin.forms.text-input input-name="last_name" input-label="Фамилия" :input-value="$user->profile->last_name" :is-required="true"/>
        <x-admin.forms.text-input input-name="first_name" input-label="Имя" :input-value="$user->profile->first_name" :is-required="true"/>
        <x-admin.forms.text-input input-name="patronymic" input-label="Отчество" :input-value="$user->profile->patronymic"/>
        <x-admin.forms.text-input input-name="email" input-label="Email" :input-value="$user->email" :is-required="true"/>
        <x-admin.forms.text-input input-type="tel" input-name="phone" input-label="Телефон" :input-value="$user->profile?->phone" input-placeholder="+7 (___) ___-__-__" class="md:w-60"/>
        <x-admin.forms.number-input input-name="age" input-label="Возраст" :input-value="$user->profile?->age" input-type="number" min-number="1" max-number="100"/>
        <x-admin.forms.text-input input-name="address" input-label="Адрес" :input-value="$user->profile?->address"/>
    </x-admin.forms.form>
@endsection
