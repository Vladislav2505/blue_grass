@extends('layouts.admin')
@section('title', 'Создание темы')

@section('content')
    <div class="font-medium text-4xl mb-10 mx-auto text-center">
        <h2>Создание темы</h2>
    </div>

    <x-admin.forms.form form-action="admin.themes.store" form-back-url="admin.themes.index">
        <x-admin.forms.text-input input-name="name" input-label="Название" :is-required="true"/>
        <x-admin.forms.checkbox-input input-name="is_active" input-label="Активность"/>
    </x-admin.forms.form>
@endsection
