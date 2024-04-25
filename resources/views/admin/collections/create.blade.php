@extends('layouts.admin')
@section('title', 'Создание коллекции')

@section('content')
    <div class="font-medium text-4xl mb-10 mx-auto text-center">
        <h2>Создание коллекции</h2>
    </div>

    <x-admin.forms.form form-action="admin.collections.store" form-back-url="admin.collections.index">
        <x-admin.forms.text-input input-name="name" input-label="Название" :is-required="true"/>
        <x-admin.forms.image-input input-name="images" input-label="Изображения" input-accept=".png, .jpg, .jpeg"
                                   :is-required="true" :is-multiple="true">
            <p class="text-[14px] text-secondary">Максимум: 10 изображений</p>
        </x-admin.forms.image-input>
        <x-admin.forms.checkbox-input input-name="is_active" input-label="Активность"/>
    </x-admin.forms.form>
@endsection
