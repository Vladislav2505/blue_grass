@extends('layouts.admin')
@section('title', 'Создание мероприятия')

@section('content')
    <div class="font-medium text-4xl mb-10 mx-auto text-center">
        <h2>Создание мероприятия</h2>
    </div>

    <x-admin.forms.form form-action="admin.events.store" form-back-url="admin.events.index">
        <x-admin.forms.text-input input-name="name" input-label="Название" :is-required="true"/>
        <x-admin.forms.date-time-input input-label="Дата проведения" input-name="date_of" :is-required="true"/>
        <x-admin.forms.select :is-multiple="false" select-label="Тема" select-name="theme_id" :is-required="true"
                              :select-options="$themes"/>
        <x-admin.forms.select :is-multiple="false" select-label="Место проведения" select-name="location_id"
                              :is-required="true"
                              :select-options="$locations"/>
        <x-admin.forms.image-input input-name="image" input-label="Изображение" input-accept=".png, .jpg, .jpeg"
                                   :is-required="true"/>
        <x-admin.forms.select :is-multiple="true" select-label="Номинации" select-name="nominations"
                              :is-required="true"
                              :select-options="$nominations"/>
        <x-admin.forms.file-input input-name="file" input-label="Положение"
                                  input-accept=".docx, .doc, .pdf"/>
        <x-admin.forms.text-input input-name="award" input-label="Главный приз"/>
        <x-admin.forms.editor-js-input input-name="description" input-label="Описание"/>
        <x-admin.forms.checkbox-input input-name="request_access" input-label="Можно оставлять заявки"/>
        <x-admin.forms.checkbox-input input-name="is_active" input-label="Активность"/>
    </x-admin.forms.form>
@endsection
