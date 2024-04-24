@extends('layouts.admin')
@section('title', 'Создание партнера')

@section('content')
    <div class="font-medium text-4xl mb-10 mx-auto text-center">
        <h2>Создание партнера</h2>
    </div>

    <x-admin.forms.form form-action="admin.partners.store" form-back-url="admin.partners.index">
        <x-admin.forms.text-input input-name="name" input-label="Название" :is-required="true"/>
        <x-admin.forms.image-input input-name="image" input-label="Изображение" input-accept=".png, .jpg, .jpeg"
                                   :is-required="true"/>
        <x-admin.forms.checkbox-input input-name="is_active" input-label="Активность"/>
    </x-admin.forms.form>
@endsection
