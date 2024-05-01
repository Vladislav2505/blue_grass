@extends('layouts.main')

@section('content')
    @include('partials.main.about')

    <section class="flex flex-col gap-10">
        @include('partials.main.tabs')

        @if($protocols->isNotEmpty())
            <div id="listContent" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @include('main.lists.protocol-list')
            </div>

            @if ($protocols->hasMorePages())
                <div id="loadMoreContainer" class="text-center">
                    <x-main.button id="loadMoreButton" button-label="Показать еще"
                                   data-url="{{route('main.index.protocols')}}"
                                   data-page="2"/>
                </div>
            @endif
        @else
            <h4 class="font-medium text-2xl text-secondary text-center">На данный момент список протоколов пуст</h4>
        @endif
    </section>
@endsection
