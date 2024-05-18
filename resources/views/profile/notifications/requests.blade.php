@extends('layouts.main')
@section('title', 'Ваши заявки')

@section('content')
    <section class="flex flex-col gap-3">
        <div class="flex flex-row justify-between items-center mb-4 sm:mb-0">
            <a href="{{route('profile.dashboard')}}" class="flex flex-row items-center text-lightblue text-xl w-fit gap-1">
                <img src="{{Vite::asset('resources/images/profile/back.svg')}}" alt="back">
                Назад
            </a>
            <a href="{{route('profile.notifications.questions')}}" class="flex flex-row items-center text-lightblue text-xl w-fit gap-1">
                Вопросы
                <img src="{{Vite::asset('resources/images/profile/next.svg')}}" alt="next">
            </a>
        </div>
        <h2 class="text-center font-medium text-3xl mb-5">Ваши заявки</h2>

        @if($requests->isNotEmpty())
            <div id="listContent"
                 class="flex flex-col justify-between items-center gap-6 p-2">
                @include('partials.profile.lists.requests-list')
            </div>
            @if ($requests->hasMorePages())
                <div id="loadMoreContainer" class="text-center mt-6">
                    <x-main.button id="loadMoreButton" button-label="Показать еще"
                                   data-url="{{route('profile.notifications.requests')}}"
                                   data-page="2"/>
                </div>
            @endif
        @else
            <h4 class="font-medium text-xl text-center">На данный момент список пуст</h4>
        @endif
    </section>

@endsection
