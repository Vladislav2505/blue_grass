@extends('layouts.admin')
@section('title', 'Пользователи')

@section('content')
    <div class="font-medium text-4xl mb-14 mx-auto text-left">
        <h2>Пользователи</h2>
    </div>

    <div class="flex flex-col gap-4">
        @if($users->isNotEmpty())
            <x-admin.tables.table :table-headers="$tableHeaders">
                @foreach($users->getCollection() as $row)
                    <tr>
                        <x-admin.tables.table-data>{{$row->id}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>{{$row->full_name}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>{{$row->email}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>{{$row->created_at}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>
                            <x-admin.tables.label :is-active="$row->isVerified()"/>
                        </x-admin.tables.table-data>
                        <x-admin.tables.table-data>
                            <x-admin.tables.label :is-active="$row->isAdmin()"/>
                        </x-admin.tables.table-data>
                        <x-admin.tables.table-data>
                            <x-admin.tables.action-buttons :is-viewable="true" :is-deletable="true" :model="$row"/>
                        </x-admin.tables.table-data>
                    </tr>
                @endforeach
            </x-admin.tables.table>
            <x-admin.tables.pagination :items="$users"/>
        @endif
    </div>
@endsection
