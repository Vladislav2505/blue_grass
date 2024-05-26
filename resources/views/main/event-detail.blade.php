@extends('layouts.main')
@section('title', $event->name)
@section('content')
    @if($event->request_access)
        @include('partials.main.requests-modal')
    @endif

    <article class="flex flex-col gap-6 md:gap-3 p-0 lg:p-2">
        <div class="flex flex-row justify-between items-center mb-0 md:mb-4">
            <a href="{{route('main.index.events')}}"
               class="flex flex-row items-center text-lightblue text-xl w-fit gap-1">
                <img src="{{Vite::asset('resources/images/profile/back.svg')}}" alt="back">
                Назад
            </a>
        </div>
        <div class="flex flex-col md:flex-row justify-between gap-3">
            <div class="flex flex-col gap-2 w-full xs:w-4/5 md:w-3/5">
                <h2 class="font-medium text-xl md:text-3xl">{{$event->name}}</h2>
                <p class="text-secondary">{{$event->date_of}}</p>
            </div>
            @if($event->request_access && !$user?->send_request)
                <div class="flex justify-end md:justify-start">
                    <x-main.button button-label="Оставить заявку" class="h-fit px-2 md:px-8 request-modal-open"/>
                </div>
            @endif
        </div>

        <div class="flex flex-row justify-between">
            <div class="flex flex-col gap-8 w-full">
                <div class="flex flex-col md:flex-row-reverse justify-between gap-5 w-full">
                    <div class="w-full flex justify-center md:justify-end">
                        <img src="{{asset('storage/' . $event->image)}}" alt="image"
                             class="event-detail-image">
                    </div>
                    <div class="flex flex-col gap-6 py-4 w-full">
                        <h3 class="font-medium text-xl lg:text-2xl">Основная информация</h3>
                        <div class="flex flex-col gap-4 text-[16px] lg:text-xl">
                            <p><b>Тема:</b> {{$event->theme->name}}</p>
                            <p><b>Место проведения:</b> {{$event->location->name}}</p>
                            <p><b>Номинации:</b> {{$event->nomination_names_string}}</p>
                            <p><b>Главный приз:</b> {{$event->award}}</p>
                            @if($event->file)
                                <p><a href="{{route('download.file', ['path' => $event->file])}}"
                                      class="text-lightblue">Скачать положение</a></p>
                            @endif
                        </div>
                    </div>

                </div>

                @if($event->description)
                    <div class="flex flex-col justify-between gap-6">
                        <h3 class="font-medium text-2xl">Описание и подробности участия</h3>
                        <x-main.editor-js-view :blocks="$event->description"/>
                    </div>
                @endif
            </div>
        </div>
    </article>
@endsection
