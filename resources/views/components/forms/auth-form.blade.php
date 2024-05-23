<div
    class="invisible-scrollbar flex flex-col items-center justify-center bg-white md:bg-lightpink h-full overflow-hidden">
    <form
        class="flex flex-col items-center bg-white py-5 px-6 w-full h-full md:h-fit md:px-12 rounded-[5px] md:w-[560px] shadow overflow-auto"
        action="{{route($formAction)}}" method="{{$formMethod}}">
        @csrf
        <div class="mb-3">
            <a href="/" class="flex flex-row gap-3 items-center">
                <img src="{{Vite::asset('resources/images/logo.svg')}}" alt="logo"
                     class="w-[72px]">
            </a>
        </div>
        <div class="text-center pb-6">
            @if($formTitle)
                <h2 class="font-medium mb-1 text-3xl md:text-4xl">{{$formTitle}}</h2>
            @endif
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
