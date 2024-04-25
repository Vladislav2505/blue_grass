@extends('layouts.admin')
@section('title', 'Создание новости')

@section('content')
    <div class="font-medium text-4xl mb-10 mx-auto text-center">
        <h2>Создание новости</h2>
    </div>

    <x-admin.forms.form form-action="admin.news.store" form-back-url="admin.news.index">
        <x-admin.forms.text-input input-name="name" input-label="Название" :is-required="true"/>
        <x-admin.forms.textarea textarea-name="description" textarea-label="Описание"
                                textarea-placeholder="Введите текст"
                                :is-required="true"/>
        <x-admin.forms.image-input input-name="image" input-label="Изображение"
                                   input-accept=".png, .jpg, .jpeg"/>
        <x-admin.forms.checkbox-input input-name="is_active" input-label="Активность"/>
    </x-admin.forms.form>
@endsection
