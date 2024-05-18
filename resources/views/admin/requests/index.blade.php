@extends('layouts.admin')
@section('title', 'Заявки')

@section('content')
    <div class="font-medium text-4xl mb-10 md:mb-7 mx-auto text-left">
        <h2>Заявки</h2>
    </div>

    <div class="flex flex-col gap-4">
        @if($requests->isNotEmpty())
            <x-admin.tables.table :table-headers="$tableHeaders">
                @foreach($requests->getCollection() as $row)
                    <tr>
                        <x-admin.tables.table-data>{{$row->id}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>{{$row->event->name}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>{{$row->full_name}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>{{$row->email}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>{{$row->phone}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>{{$row->date_of_birth}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>{{$row->participants_number}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>{{$row->created_at}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>{{$row->status->label()}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>
                            <x-admin.tables.action-buttons :is-viewable="true" :is-deletable="true" :model="$row"/>
                        </x-admin.tables.table-data>
                    </tr>
                @endforeach
            </x-admin.tables.table>
            <x-admin.tables.pagination :items="$requests"/>
        @else
            <h3 class="font-medium text-2xl text-center">Список пуст</h3>
        @endif
    </div>
@endsection
