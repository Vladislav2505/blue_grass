@extends('layouts.admin')
@section('title', 'Мероприятия')

@section('content')
    <div class="font-medium text-4xl mb-10 md:mb-4 mx-auto text-left">
        <h2>Мероприятия</h2>
    </div>

    <div class="flex flex-col gap-4">
        <div class="flex justify-end">
            <a href="{{route('admin.events.create')}}">
                <x-admin.button button-label="Добавить мероприятие"/>
            </a>
        </div>

        @if($events->isNotEmpty())
            <x-admin.tables.table :table-headers="$tableHeaders">
                @foreach($events->getCollection() as $row)
                    <tr>
                        <x-admin.tables.table-data>{{$row->id}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>{{$row->name}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>{{$row->date_of}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>{{$row->location->name}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>{{$row->theme->name}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>{{$row->updated_at}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>
                            <x-admin.tables.label :is-active="$row->is_active"/>
                        </x-admin.tables.table-data>
                        <x-admin.tables.table-data>
                            <x-admin.tables.action-buttons :is-updatable="true" :is-deletable="true" :model="$row"/>
                        </x-admin.tables.table-data>
                    </tr>
                @endforeach
            </x-admin.tables.table>
            <x-admin.tables.pagination :items="$events"/>
        @endif
    </div>
@endsection
