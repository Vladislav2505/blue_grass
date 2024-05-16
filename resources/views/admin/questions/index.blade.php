@extends('layouts.admin')
@section('title', 'Вопросы')

@section('content')
    <div class="font-medium text-4xl mb-10 md:mb-7 mx-auto text-left">
        <h2>Вопросы</h2>
    </div>

    <div class="flex flex-col gap-4">
        @if($questions->isNotEmpty())
            <x-admin.tables.table :table-headers="$tableHeaders">
                @foreach($questions->getCollection() as $row)
                    <tr>
                        <x-admin.tables.table-data>{{$row->id}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>{{$row->full_name}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>{{$row->email}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>{{$row->created_at}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>
                            <x-admin.tables.label :is-active="$row->is_closed"/>
                        </x-admin.tables.table-data>
                        <x-admin.tables.table-data>
                            <x-admin.tables.action-buttons :is-viewable="true" :is-deletable="true" :model="$row"/>
                        </x-admin.tables.table-data>
                    </tr>
                @endforeach
            </x-admin.tables.table>
            <x-admin.tables.pagination :items="$questions"/>
        @else
            <h3 class="font-medium text-2xl text-center">Список пуст</h3>
        @endif
    </div>
@endsection
