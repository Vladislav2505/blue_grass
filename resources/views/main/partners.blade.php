@extends('layouts.main')
@section('title', 'Партнеры')

@section('content')
    <section class="flex flex-col gap-4">
        <h2 class="font-bold text-3xl mb-5">Партнеры</h2>

        @if($partners->isNotEmpty())
            <div id="listContent"
                 class="mx-auto grid grid-cols-1 xs:grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @include('partials.main.lists.partner-list')
            </div>
            @if ($partners->hasMorePages())
                <div id="loadMoreContainer" class="text-center mt-6">
                    <x-main.button id="loadMoreButton" button-label="Показать еще"
                                   data-url="{{route('main.partners.show')}}"
                                   data-page="2"/>
                </div>
            @endif
        @else
            <h4 class="font-medium text-2xl text-center">На данный момент список партнеров пуст</h4>
        @endif
    </section>
@endsection
