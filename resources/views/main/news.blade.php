@extends('layouts.main')
@section('title', 'Новости')

@section('content')
    <section class="flex flex-col gap-4">
        <h2 class="font-bold text-3xl mb-5">Новости</h2>

        @if($newsList->isNotEmpty())
            <div id="listContent"
                 class="flex flex-col justify-between items-center gap-6 p-2">
                @include('partials.main.lists.news-list')
            </div>
            @if ($newsList->hasMorePages())
                <div id="loadMoreContainer" class="text-center mt-6">
                    <x-main.button id="loadMoreButton" button-label="Показать еще"
                                   data-url="{{route('main.news.show')}}"
                                   data-page="2"/>
                </div>
            @endif
        @else
            <h4 class="font-medium text-2xl text-center">На данный момент список новостей пуст</h4>
        @endif
    </section>
@endsection
