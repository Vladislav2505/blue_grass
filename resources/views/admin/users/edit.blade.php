@extends('layouts.admin')
@section('title', 'Редактирование места проведения')

@section('content')
    <div class="font-medium text-4xl mb-10 mx-auto text-center">
        <h2>Редактирование места проведения</h2>
    </div>

    <x-admin.forms.form form-action="admin.locations.update" :form-action-param="['location' => $location]"
                        form-back-url="admin.locations.index" form-method="PUT">
        <x-admin.forms.text-input input-name="name" input-label="Название" :input-value="$location->name" :is-required="true"/>
        <x-admin.forms.checkbox-input input-name="is_active" input-label="Активность"
                                      :input-is-checked="$location->is_active"/>
    </x-admin.forms.form>
@endsection
