@extends('layouts.admin')
@section('title', 'Редактирование коллекции')

@section('content')
    <div class="font-medium text-4xl mb-10 mx-auto text-center">
        <h2>Редактирование коллекции</h2>
    </div>

    <x-admin.forms.form form-action="admin.collections.update" :form-action-param="['collection' => $collection]"
                        form-back-url="admin.collections.index" form-method="PUT">
        <x-admin.forms.text-input input-name="name" input-label="Название" :input-value="$collection->name" :is-required="true"/>
        <x-admin.forms.image-input input-name="images" input-label="Изображения" input-accept=".png, .jpg, .jpeg"
                                   :is-required="true" :input-value="$collection->images" :is-multiple="true">
            <p class="text-[14px] text-secondary">Максимум: 10 изображений</p>
        </x-admin.forms.image-input>
        <x-admin.forms.checkbox-input input-name="is_active" input-label="Активность"
                                      :input-is-checked="$collection->is_active"/>
    </x-admin.forms.form>
@endsection
