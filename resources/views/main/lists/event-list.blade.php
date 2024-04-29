@foreach($events as $event)
    <article class="card-border card-hover flex flex-col justify-between ">
        <div class="w-full">
            <a href="{{route('main.event.show', ['event' => $event->slug])}}">
                <img src="{{asset('storage/' . $event->image)}}" alt="event-image"
                     class="max-w-full w-full object-cover rounded-t-[5px] h-[350px]">
            </a>
        </div>
        <div class="h-full flex flex-col justify-between gap-3 p-4 border-t border-t-lightgray">
            <a href="{{route('main.event.show', ['event' => $event->slug])}}">
                <h3 class="font-medium">{{$event->name}}</h3>
            </a>

            <div class="text-secondary text-[14px]">
                <p>{{$event->date_of}}</p>
                <p>{{$event->location->name}}</p>
            </div>

            @if($event->request_access)
                <a href="{{route('main.event.show', ['event' => $event->slug])}}"
                   class="text-lightblue uppercase">Оставить заявку »</a>
            @endif
        </div>
    </article>
@endforeach
