@extends('layouts.main')

@section('content')
    <x-main.about/>

    <nav class="w-full mx-auto bg-lightgray rounded-[5px] sm:w-5/6 flex flex-row justify-between text-white text-[12px] xs:text-[16px] gap-[1px]">
        <div class="w-1/2 {{Request::is('/') ? 'bg-blue-hover' : 'bg-lightblue btn-hover'}} text-center rounded-l-[5px]">
            <a href="{{route('main.events')}}" class="py-3 flex flex-row items-center justify-center gap-1">
                <img src="{{Vite::asset('resources/images/menu/events.svg')}}"
                     alt="events">
                <p>Мероприятия</p>
            </a>
        </div>
        <div class="w-1/2 {{Request::is('protocols') ? 'bg-blue-hover' : 'bg-lightblue btn-hover'}} text-center rounded-r-[5px]">
            <a href="/protocols" class="py-3 flex flex-row items-center justify-center gap-1">
                <img src="{{Vite::asset('resources/images/menu/protocols.svg')}}"
                     alt="protocols">
                <p>Протоколы</p>
            </a>
        </div>
    </nav>
@endsection
