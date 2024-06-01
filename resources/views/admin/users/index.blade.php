@extends('layouts.admin')
@section('title', 'Пользователи')

@section('content')
    <div class="font-medium text-4xl mb-10 md:mb-4 mx-auto text-left">
        <h2>Пользователи</h2>
    </div>

    <div class="flex flex-col gap-4">
        <div class="flex justify-end">
            <a href="{{route('admin.users.create')}}">
                <x-admin.button button-label="Добавить пользователя"/>
            </a>
        </div>

        @if($users->isNotEmpty())
            <x-admin.tables.table :table-headers="$tableHeaders">
                @foreach($users->getCollection() as $row)
                    <tr>
                        <x-admin.tables.table-data>{{$row->id}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>{{$row->profile->full_name}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>{{$row->email}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>{{$row->created_at}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>
                            <x-admin.tables.label :is-active="$row->isVerified()"/>
                        </x-admin.tables.table-data>
                        <x-admin.tables.table-data>
                            <x-admin.tables.label :is-active="$row->isAdmin()"/>
                        </x-admin.tables.table-data>
                        <x-admin.tables.table-data>
                            @if(Auth::id() === $row->id)
                                <x-admin.tables.action-buttons :is-updatable="true" :is-deletable="true" :model="$row"/>
                            @else
                                <x-admin.tables.action-buttons :is-viewable="true" :is-deletable="true" :model="$row"/>
                            @endif
                        </x-admin.tables.table-data>
                    </tr>
                @endforeach
            </x-admin.tables.table>
            <x-admin.tables.pagination :items="$users"/>
        @else
            <h3 class="font-medium text-2xl text-center">Список пуст</h3>
        @endif
    </div>
@endsection
