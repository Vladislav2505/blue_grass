<div class="w-fit">
    <a href="{{route(\App\Providers\RouteServiceProvider::HOME)}}" class="flex flex-row items-center gap-4">
        <img class="object-contain"
             @if($attributes->get('small'))
                 src="{{Vite::asset("resources/images/logo-small.svg")}}"
             @else
                 src="{{Vite::asset("resources/images/logo-big.svg")}}"
             @endif
             alt="logo">
        <div>
            <h1 class="font-bold text-xl xs:text-2xl sm:text-3xl">{{config('site.name')}}</h1>
            <p class="text-[14px] xs:text-[16px] block text-secondary">{{config('site.second_name')}}</p>
        </div>
    </a>
</div>
