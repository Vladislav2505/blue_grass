@extends('layouts.admin')
@section('title', 'Новости')

@section('content')
    <div class="font-medium text-4xl mb-10 md:mb-4 mx-auto text-left">
        <h2>Новости</h2>
    </div>

    <div class="flex flex-col gap-4">
        <div class="flex justify-end">
            <a href="{{route('admin.news.create')}}">
                <x-admin.button button-label="Добавить новость"/>
            </a>
        </div>

        @if($news->isNotEmpty())
            <x-admin.tables.table :table-headers="$tableHeaders">
                @foreach($news->getCollection() as $row)
                    <tr>
                        <x-admin.tables.table-data>{{$row->id}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>{{$row->name}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>{{$row->updated_at}}</x-admin.tables.table-data>
                        <x-admin.tables.table-data>
                            <x-admin.tables.label :is-active="$row->is_active"/>
                        </x-admin.tables.table-data>
                        <x-admin.tables.table-data>
                            <x-admin.tables.action-buttons :is-updatable="true" :is-deletable="true" :model="$row"
                                                          url-param="news"/>
                        </x-admin.tables.table-data>
                    </tr>
                @endforeach
            </x-admin.tables.table>
            <x-admin.tables.pagination :items="$news"/>
        @endif
    </div>
@endsection
