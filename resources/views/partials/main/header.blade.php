<header class="bg-white sticky top-0 w-full z-50 shadow">
    <div class="flex justify-between items-center max-w-[1420px] mx-auto px-2 xs:px-6 py-3">
        <x-main.logo/>

        <nav class="px-[15px]">
            @include('partials.main.burger-menu')

            <ul class="hidden space-x-[60px] font-light xl:space-x-[70px] lg:text-xl lg:flex">
                @foreach(config('menu.main') as $url => $point)
                    <li><a href="{{$url}}" class="hover:text-lightblue transition-colors">{{$point}}</a></li>
                @endforeach
            </ul>
            <button id="open_burger" class="lg:hidden flex items-center">
                <img src="{{Vite::asset('resources/images/burger.svg')}}" alt="burger" class="w-[24px] y-[24px]">
            </button>
        </nav>

        <div class="hidden lg:flex gap-7">
            <a href="{{route(auth()->user()?->isAdmin() ? \App\Providers\RouteServiceProvider::ADMIN : \App\Providers\RouteServiceProvider::PROFILE)}}"
               class="flex">
                <img src="{{Vite::asset('resources/images/profile.svg')}}"
                     alt="profile">
            </a>
            <x-main.button button-label="Задать вопрос"/>
        </div>
    </div>
</header>
