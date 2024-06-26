@extends('layouts.admin')
@section('title', 'Редактирование протокола')

@section('content')
    <div class="font-medium text-4xl mb-10 mx-auto text-center">
        <h2>Редактирование протокола</h2>
    </div>

    <x-admin.forms.form form-action="admin.protocols.update" form-back-url="admin.protocols.index"
                        :form-action-param="['protocol' => $protocol]" form-method="PUT">
        <x-admin.forms.text-input input-name="name" input-label="Название" :is-required="true"
                                  :input-value="$protocol->name"/>
        <x-admin.forms.file-input input-name="file" input-label="Файл" :is-required="true"
                                  input-accept=".docx, .doc, .pdf"
                                  :input-value="$protocol->file"/>
        <x-admin.forms.date-input input-label="Дата постановления" input-name="date"
                                  :input-value="$protocol->date"/>
        <x-admin.forms.checkbox-input input-name="is_active" input-label="Активность"
                                      :input-is-checked="$protocol->is_active"/>
    </x-admin.forms.form>
@endsection
