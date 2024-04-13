@extends('layouts.admin')
@section('title', 'Создание места проведения')

@section('content')
    <div class="font-medium text-4xl mb-10 mx-auto text-center">
        <h2>Создание места проведения</h2>
    </div>

    <x-admin.forms.form form-action="admin.locations.store" form-back-url="admin.locations.index">
        <x-admin.forms.text-input input-name="name" input-label="Название"/>
        <x-admin.forms.checkbox-input input-name="is_active" input-label="Активность"/>
    </x-admin.forms.form>
@endsection
