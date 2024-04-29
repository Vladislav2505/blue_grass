@extends('layouts.main')

@section('content')
    @include('partials.main.about')

    <section class="flex flex-col gap-10">
        @include('partials.main.tabs')

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
            @foreach($events as $event)
                <article class="card-border card-hover flex flex-col justify-between ">
                    <div class="w-full">
                        <img src="{{asset('storage/' . $event->image)}}" alt="event-image" class="max-w-full w-full object-cover rounded-t-[5px] h-[350px]">
                    </div>
                    <div class="h-full flex flex-col justify-between gap-3 p-4 border-t border-t-lightgray">
                        <h3 class="font-medium">{{$event->name}}</h3>

                        <div class="text-secondary text-[14px]">
                            <p>{{$event->date_of}}</p>
                            <p>{{$event->location->name}}</p>
                        </div>

                        <a href="/" class="text-lightblue uppercase">Оставить заявку »</a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endsection
