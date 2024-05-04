@foreach($newsList as $news)
    <article class="card-border w-full border border-lightgray rounded-[5px] shadow">
        <div class="p-4">
            <div class="flex flex-col lg:flex-row justify-between gap-6">
                @if($news->image)
                    <div class="w-full h-full sm:w-fit sm:h-fit">
                        <img src="{{asset('storage/' . $news->image)}}" alt="event-image"
                             class="news-image">
                    </div>
                @endif
                <div class="w-full flex flex-col">
                    <p class="text-right text-secondary mb-2 sm:mb-0">{{$news->toArray()['updated_at']}}</p>
                    <h4 class="text-xl font-medium text-wrap break-words mb-2">{{$news->name}}</h4>
                    <p class="font-light w-full text-wrap break-words text-justify">{{$news->description}}</p>
                </div>
            </div>
        </div>
    </article>
@endforeach
