<div class="w-fit">
    <a href="{{route(\App\Providers\RouteServiceProvider::HOME)}}" class="flex flex-row items-center gap-4">
        <img
            src="{{Vite::asset("resources/images/logo.svg")}}"
            @if($attributes->get('small'))
                class="w-[72px] h-[72px] object-contain"
            @else
                class="w-[95px] h-[95px] object-contain"
            @endif
            alt="logo">
        <div>
            <h1 class="font-bold text-xl xs:text-2xl sm:text-3xl">{{config('site.name')}}</h1>
            <p class="text-[14px] xs:text-[16px] block text-secondary">{{config('site.second_name')}}</p>
        </div>
    </a>
</div>
