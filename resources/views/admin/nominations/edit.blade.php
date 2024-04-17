@extends('layouts.admin')
@section('title', 'Редактирование номинации')

@section('content')
    <div class="font-medium text-4xl mb-10 mx-auto text-center">
        <h2>Редактирование номинации</h2>
    </div>

    <x-admin.forms.form form-action="admin.nominations.update" :form-action-param="['nomination' => $nomination]"
                        form-back-url="admin.nominations.index" form-method="PUT">
        <x-admin.forms.text-input input-name="name" input-label="Название" :input-value="$nomination->name" :is-required="true"/>
        <x-admin.forms.checkbox-input input-name="is_active" input-label="Активность"
                                      :input-is-checked="$nomination->is_active"/>
    </x-admin.forms.form>
@endsection
