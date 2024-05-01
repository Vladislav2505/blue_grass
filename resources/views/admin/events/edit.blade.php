@extends('layouts.admin')
@section('title', 'Редактирование мероприятия')

@section('content')
    <div class="font-medium text-4xl mb-10 mx-auto text-center">
        <h2>Редактирование мероприятия</h2>
    </div>

    <x-admin.forms.form form-action="admin.events.update" form-back-url="admin.events.index"
                        :form-action-param="['event' => $event]" form-method="PUT">
        <x-admin.forms.text-input input-name="name" input-label="Название" :is-required="true"
                                  :input-value="$event->name"/>
        <x-admin.forms.date-time-input input-label="Дата проведения" input-name="date_of" :is-required="true"
                                       :input-value="$event->toArray()['date_of']"/>
        <x-admin.forms.select :is-multiple="false" select-label="Тема" select-name="theme_id" :is-required="true"
                              :selected-options="$event->theme_id"
                              :select-options="$themes"
        />
        <x-admin.forms.select :is-multiple="false" select-label="Место проведения" select-name="location_id"
                              :is-required="true"
                              :select-options="$locations"
                              :selected-options="$event->location_id"
        />
        <x-admin.forms.image-input input-name="image" input-label="Изображение" input-accept=".png, .jpg, .jpeg"
                                   :is-required="true" :input-value="$event->image"/>
        <x-admin.forms.select :is-multiple="true" select-label="Номинации" select-name="nominations"
                              :is-required="true"
                              :select-options="$nominations"
                              :selected-options="$event->nomination_ids"
        />
        <x-admin.forms.file-input input-name="file" input-label="Положение"
                                  input-accept=".docx, .doc, .pdf"
                                  :input-value="$event->file ?? ''"/>
        <x-admin.forms.text-input input-name="award" input-label="Главный приз" :input-value="$event->award"/>
        <x-admin.forms.editor-js-input input-name="description" input-label="Описание"
                                       :editor-data="$event->description"/>
        <x-admin.forms.checkbox-input input-name="request_access" input-label="Можно оставлять заявки"
                                      :input-is-checked="$event->request_access"/>
        <x-admin.forms.checkbox-input input-name="is_active" input-label="Активность"
                                      :input-is-checked="$event->is_active"/>
    </x-admin.forms.form>
@endsection
