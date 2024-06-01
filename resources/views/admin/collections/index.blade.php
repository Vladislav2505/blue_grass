@extends('layouts.admin')
@section('title', 'Галерея')

@section('content')
    <div class="font-medium text-4xl mb-10 md:mb-4 mx-auto text-left">
        <h2>Галерея</h2>
    </div>

    <div class="flex flex-col gap-4">
        <div class="flex justify-end">
            <a href="{{route('admin.collections.create')}}">
                <x-admin.button button-label="Добавить коллекцию"/>
            </a>
        </div>

        @if($collections->isNotEmpty())
            <x-admin.tables.table :table-headers="$tableHeaders">
                @foreach($collections->getCollection() as $row)
                    <tr>
                        <x-admin.tables.table-data>{{$row->id}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>{{$row->name}}</x-admin.tables.table-data>
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
            <x-admin.tables.pagination :items="$collections"/>
        @else
            <h3 class="font-medium text-2xl text-center">Список пуст</h3>
        @endif
    </div>
@endsection
