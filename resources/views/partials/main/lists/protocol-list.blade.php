@foreach($protocols as $protocol)
    <article class="card-border card-hover flex flex-col justify-between">
        <div class="h-full flex flex-col justify-between gap-5 p-4 border-t border-t-lightgray">
            <h3 class="font-medium text-center text-xl">{{$protocol->name}}</h3>

            @if($protocol->date)
                <div class="text-secondary text-center">
                    <p>{{$protocol->date}}</p>
                </div>
            @endif

            <div class="mx-auto">
                <a href="{{route('download.file', ['path' => $protocol->file])}}">
                    <x-main.button button-label="Скачать" class="w-fit px-8 !bg-white !py-2 border border-lightblue !text-lightblue"/>
                </a>
            </div>
        </div>
    </article>
@endforeach
