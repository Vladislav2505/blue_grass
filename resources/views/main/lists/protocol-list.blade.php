@foreach($protocols as $protocol)
    <article class="card-border card-hover flex flex-col justify-between">
        <div class="h-full flex flex-col justify-between gap-5 p-4 border-t border-t-lightgray">
            <h3 class="font-medium text-center text-xl">{{$protocol->name}}</h3>

            <div class="text-secondary text-center">
                <p>{{$protocol->date}}</p>
            </div>

            <div class="mx-auto">
                <a href="{{route('download.file', ['path' => $protocol->file])}}">
                    <x-main.button button-label="Скачать" class="w-fit px-8 !bg-blue-hover !py-2"/>
                </a>
            </div>
        </div>
    </article>
@endforeach
