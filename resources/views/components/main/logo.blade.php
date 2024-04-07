<div class="w-fit">
    <a href="{{route('home')}}" class="flex flex-row items-center gap-4">
        <img class="object-contain w-[{{$attributes->get('width')}}px]"
             src="{{Vite::asset('resources/images/logo.svg')}}"
             alt="logo">
        <div>
            <h1 class="font-bold text-xl xs:text-2xl sm:text-3xl">{{config('site.name')}}</h1>
            <p class="hidden xs:block text-secondary">{{config('site.second_name')}}</p>
        </div>
    </a>
</div>
