@extends('layouts.admin')
@section('title', 'Редактирование партнера')

@section('content')
    <div class="font-medium text-4xl mb-10 mx-auto text-center">
        <h2>Редактирование партнера</h2>
    </div>

    <x-admin.forms.form form-action="admin.partners.update" :form-action-param="['partner' => $partner]"
                        form-back-url="admin.partners.index" form-method="PUT">
        <x-admin.forms.text-input input-name="name" input-label="Название" :input-value="$partner->name" :is-required="true"/>
        <x-admin.forms.image-input input-name="image" input-label="Фото" input-accept=".png, .jpg, .jpeg"
                                   :is-required="true" :input-value="$partner->image"/>
        <x-admin.forms.checkbox-input input-name="is_active" input-label="Активность"
                                      :input-is-checked="$partner->is_active"/>
    </x-admin.forms.form>
@endsection
