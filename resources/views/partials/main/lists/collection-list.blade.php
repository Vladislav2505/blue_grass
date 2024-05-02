@foreach($collections as $collection)
    @if(!empty($collection->images))
        <article class="flex flex-col gap-5 p-4">
            <h4 class="text-2xl">{{$collection->name}}</h4>
            <div class="mx-auto grid grid-cols-1 xs:grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                @foreach($collection->images as $image)
                    <a href="{{ asset('storage/' . $image) }}" target="_blank">
                        <img src="{{ asset('storage/' . $image) }}" alt="collection-image" class="border border-lightgray w-[400px] h-[200px] object-cover hover:opacity-95 transition-opacity">
                    </a>
                @endforeach
            </div>
        </article>
    @endif
@endforeach
