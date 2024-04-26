@extends('layouts.admin')
@section('title', 'Просмотр пользователя')

@section('content')
    <div class="font-medium text-4xl mb-10 mx-auto text-center">
        <h2>Пользователь</h2>
    </div>

    <x-admin.show.show form-back-url="admin.users.index" :model="$user">
        <x-admin.show.data data-label="Фамилия" :data-value="$user->last_name"/>
        <x-admin.show.data data-label="Имя" :data-value="$user->first_name"/>
        @if($user->patronymic)
            <x-admin.show.data data-label="Отчество" :data-value="$user->patronymic"/>
        @endif
        <x-admin.show.data data-label="Email" :data-value="$user->email"/>
        <x-admin.show.data data-label="Верифицирован" :data-value="$user->isVerified() ? 'Да' : 'Нет'"/>
        <x-admin.show.data data-label="Администратор" :data-value="$user->isAdmin() ? 'Да' : 'Нет'"/>
        <x-admin.show.data data-label="Дата регистрации" :data-value="$user->created_at"/>
    </x-admin.show.show>
@endsection
