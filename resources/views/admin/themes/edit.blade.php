@extends('layouts.admin')
@section('title', 'Редактирование темы')

@section('content')
    <div class="font-medium text-4xl mb-10 mx-auto text-center">
        <h2>Редактирование темы</h2>
    </div>

    <x-admin.forms.form form-action="admin.themes.update" :form-action-param="['theme' => $theme]" form-back-url="admin.themes.index" form-method="PUT">
        <x-admin.forms.text-input input-name="name" input-label="Название" :input-value="$theme->name"/>
        <x-admin.forms.checkbox-input input-name="is_active" input-label="Активность" :input-is-checked="$theme->is_active"/>
    </x-admin.forms.form>
@endsection
