@include('partials.main.question-modal')
<header class="bg-white sticky top-0 w-full shadow border-lightgray">
    <div class="flex justify-between items-center max-w-[1420px] mx-auto px-3 md:px-6 py-3">
        <x-main.logo/>
        <nav>
            @include('partials.main.burger-menu')

            <ul class="hidden space-x-[60px] font-light xl:space-x-[70px] lg:text-xl lg:flex">
                @foreach(config('menu.main') as $url => $point)
                    <li><a href="{{$url}}" class="hover:text-lightblue transition-colors">{{$point}}</a></li>
                @endforeach
            </ul>
            <div class="flex flex-row items-center justify-between lg:hidden gap-5">
                <button id="open_burger" class="">
                    <img src="{{Vite::asset('resources/images/burger.svg')}}" alt="burger" class="w-[24px] y-[24px]">
                </button>
                <button class="question-modal-open">
                    <img src="{{Vite::asset('resources/images/question.svg')}}" alt="question">
                </button>
            </div>
        </nav>

        <div class="hidden lg:flex gap-7">
            <a href="{{route(auth()->user()?->isAdmin() ? \App\Providers\RouteServiceProvider::ADMIN : \App\Providers\RouteServiceProvider::PROFILE)}}"
               class="flex">
                <img src="{{Vite::asset('resources/images/profile.svg')}}"
                     alt="profile">
            </a>
            <x-main.button button-label="Задать вопрос" class="question-modal-open"/>
        </div>
    </div>
</header>
