<header class="flex flex-row justify-between items-center border-b-2 h-fit py-4 pr-8 xl:justify-end">
    <div class="px-4 xl:hidden">
        <button id="open_sidebar">
            <img src="{{Vite::asset('resources/images/logo.svg')}}" alt="logo" class="w-[55px]">
        </button>
    </div>
    <div class="flex justify-end items-center gap-3 text-right">
        <p>{{auth()->user()->profile->full_name}}</p>
        <a href="{{route(\App\Providers\RouteServiceProvider::HOME)}}"><img src="{{Vite::asset('resources/images/profile.svg')}}" class="w-[42px]" alt="profile"></a>
    </div>
</header>
