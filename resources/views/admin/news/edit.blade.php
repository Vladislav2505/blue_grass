@extends('layouts.admin')
@section('title', 'Редактирование новости')

@section('content')
    <div class="font-medium text-4xl mb-10 mx-auto text-center">
        <h2>Редактирование новости</h2>
    </div>

    <x-admin.forms.form form-action="admin.news.update" form-back-url="admin.news.index"
                        :form-action-param="['news' => $news]" form-method="PUT">
        <x-admin.forms.text-input input-name="name" input-label="Название" :is-required="true"
                                  :input-value="$news->name"/>
        <x-admin.forms.textarea textarea-name="description" textarea-label="Описание"
                                textarea-placeholder="Введите текст"
                                :is-required="true"
                                :textarea-value="$news->description"/>
        <x-admin.forms.image-input input-name="image" input-label="Изображение"
                                   input-accept=".png, .jpg, .jpeg"
                                   :input-value="$news->image"/>
        <x-admin.forms.checkbox-input input-name="is_active" input-label="Активность"
                                      :input-is-checked="$news->is_active"/>
    </x-admin.forms.form>
@endsection
