@extends('layouts.main')
@section('title', 'Галерея')

@section('content')
    <section class="flex flex-col gap-4">
        <h2 class="font-bold text-3xl mb-5">Галерея</h2>

        @if($collections->isNotEmpty())
            <div id="listContent"
                 class="flex flex-col gap-5">
                @include('partials.main.lists.collection-list')
            </div>
            @if ($collections->hasMorePages())
                <div id="loadMoreContainer" class="text-center mt-6">
                    <x-main.button id="loadMoreButton" button-label="Показать еще"
                                   data-url="{{route('main.gallery.show')}}"
                                   data-page="2"/>
                </div>
            @endif
        @else
            <h4 class="font-medium text-2xl text-center">На данный момент список партнеров пуст</h4>
        @endif
    </section>
@endsection
