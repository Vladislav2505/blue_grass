<div class="flex bg-white md:bg-lightpink justify-center md:items-center h-screen">
    <form
        class="flex flex-col items-center bg-white my-2 py-5 px-6 w-screen md:px-12 rounded-[5px] md:w-[560px]"
        action="{{route($formAction)}}" method="POST">
        @csrf
        <div class="mb-3">
            <a href="/" class="flex flex-row gap-3 items-center">
                <img src="{{Vite::asset('resources/images/favicon.svg')}}" alt="logo"
                     class="w-[70px]">
            </a>
        </div>
        <div class="text-center pb-6">
            <h2 class="font-medium mb-1 text-4xl md:text-5xl">{{$formTitle}}</h2>
            @if($formLabel)
                <p class="text-secondary">
                    {!! $formLabel !!}
                </p>
            @endif
        </div>
        <div class="w-full flex flex-col gap-4">
            {{$slot}}
        </div>
    </form>
</div>
