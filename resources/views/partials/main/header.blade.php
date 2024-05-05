@include('partials.main.question-modal')
<header class="bg-white sticky top-0 w-full shadow border-lightgray z-50">
    <div class="flex justify-between items-center max-w-[1500px] mx-auto px-5 md:px-6 py-2">
        <x-main.logo/>
        <nav>
            @include('partials.main.burger-menu')

            <ul class="hidden space-x-[60px] font-light xl:space-x-[70px] lg:text-2xl lg:flex">
                @foreach(config('menu.main') as $url => $point)
                    <li>
                        <a href="{{$url}}"
                           class="{{Str::contains($currentUrl, $url) ? 'text-lightblue' : 'text-main hover:text-lightblue transition-colors'}}">{{$point}}
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="flex flex-row items-center justify-between lg:hidden gap-5">
                <button id="open_burger" class="">
                    <img src="{{Vite::asset('resources/images/burger.svg')}}" alt="burger" class="w-[24px] y-[24px]">
                </button>
            </div>
        </nav>

        <div class="hidden lg:flex gap-6">
            @if(! Request::is('profile'))
                <a href="{{route(auth()->user()?->isAdmin() ? \App\Providers\RouteServiceProvider::ADMIN : \App\Providers\RouteServiceProvider::PROFILE)}}"
                   class="flex">
                    <img src="{{Vite::asset('resources/images/profile.svg')}}"
                         alt="profile">
                </a>
            @endif
            <button class="question-modal-open">
                <img src="{{Vite::asset('resources/images/question.svg')}}" alt="question">
            </button>
        </div>

    </div>
</header>
