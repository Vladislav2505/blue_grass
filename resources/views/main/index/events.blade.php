@extends('layouts.main')

@section('content')
    @include('partials.main.about')

    <section class="flex flex-col gap-8">
        @include('partials.main.tabs')

        @if($events->isNotEmpty())
            <div id="listContent" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
                @include('main.lists.event-list')
            </div>
            @if ($events->hasMorePages())
                <div id="loadMoreContainer" class="text-center">
                    <x-main.button id="loadMoreButton" button-label="Показать еще"
                                   data-url="{{route('main.index.events')}}"
                                   data-page="2"/>
                </div>
            @endif
        @else
            <h4 class="font-medium text-2xl text-secondary text-center">На данный момент список мероприятий пуст</h4>
        @endif
    </section>
@endsection
