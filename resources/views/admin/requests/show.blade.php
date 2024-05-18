@extends('layouts.admin')
@section('title', 'Просмотр заявки')

@section('content')
    <div class="font-medium text-4xl mb-10 mx-auto text-center">
        <h2>Заявка</h2>
    </div>

    <x-admin.show.show form-back-url="admin.requests.index" :model="$request" :is-accepted="true">
        @if($request->user_id)
            <x-admin.show.data-url data-label="ID Пользователя" :data-value="$request->user_id" url="admin.users.show"
                                   :params="['user' => $request->user_id]"/>
        @endif
        <x-admin.show.data data-label="Статус" :data-value="$request->status->label()"/>
        <x-admin.show.data data-label="Мероприятие" :data-value="$request->event->name"/>
        <x-admin.show.data data-label="ФИО" :data-value="$request->full_name"/>
        <x-admin.show.data data-label="Email" :data-value="$request->email"/>
        <x-admin.show.data data-label="Телефон" :data-value="$request->phone"/>
        <x-admin.show.data data-label="Дата рождения" :data-value="$request->date_of_birth"/>
        <x-admin.show.data data-label="Адрес" :data-value="$request->address"/>
        @if($request->team_name)
            <x-admin.show.data data-label="Название коллектива" :data-value="$request->team_name"/>
        @endif
        <x-admin.show.data data-label="ФИО руководителя" :data-value="$request->supervisor_full_name"/>
        <x-admin.show.data data-label="Название организации" :data-value="$request->organization_name"/>
        @if($request->date_creation_team)
            <x-admin.show.data data-label="Дата создания коллектива" :data-value="$request->date_creation_team"/>
        @endif
        @if($request->participants_number)
            <x-admin.show.data data-label="Кол-во участников" :data-value="$request->participants_number"/>
        @endif
        <x-admin.show.data data-label="Дата заявки" :data-value="$request->created_at"/>
        @if($request->status === \App\Enums\RequestStatus::Pending)
            <div
                class="px-5 pt-4 xl:pt-[27px] xl:min-h-[78px] rounded-t-lg xl:rounded-e-none xl:rounded-s-lg">
                <p>Решение:</p>
            </div>
            <form
                action="{{route("admin.requests.update", ['request' => $request])}}"
                method="POST" class="relative p-5 pt-1 xl:pt-6 rounded-b-lg xl:rounded-s-none xl:rounded-e-lg">
                @csrf
                @method('PUT')
                <x-admin.forms.submit class="text-[12px]"
                                      submit-name="{{\App\Enums\RequestStatus::Accepted->name}}"
                                      submit-label="Принять"/>
                <x-admin.forms.submit class="bg-secondary text-[12px]"
                                      submit-name="{{\App\Enums\RequestStatus::Rejected->name}}"
                                      submit-label="Отклонить"/>
            </form>
        @else
            <x-admin.show.data data-label="Статус" :data-value="$request->status->label()"/>
        @endif
    </x-admin.show.show>
@endsection
