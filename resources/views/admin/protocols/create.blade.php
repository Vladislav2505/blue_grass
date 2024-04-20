@extends('layouts.admin')
@section('title', 'Создание протокола')

@section('content')
    <div class="font-medium text-4xl mb-10 mx-auto text-center">
        <h2>Создание протокола</h2>
    </div>

    <x-admin.forms.form form-action="admin.protocols.store" form-back-url="admin.protocols.index">
        <x-admin.forms.file-input input-name="file" input-label="Файл" :is-required="true"
                                  input-accept=".docx, .doc, .pdf"/>
        <x-admin.forms.text-input input-name="name" input-label="Название" :is-required="true"/>
        <x-admin.forms.date-input input-label="Дата постановления" input-name="date"/>
        <x-admin.forms.checkbox-input input-name="is_downloadable" input-label="Протокол можно скачать"/>
        <x-admin.forms.checkbox-input input-name="is_active" input-label="Активность"/>
    </x-admin.forms.form>
@endsection
