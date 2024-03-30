<header class="bg-white sticky top-0 w-full z-50 shadow">
    <div class="flex justify-between items-center max-w-[1420px] mx-auto px-6 py-1">
        <a href="/">
            <div class="flex items-center">
                <img class="object-contain max-w-[110px] sm:max-w-[140px] lg:max-w-[140px]"
                     src="{{Vite::asset('resources/images/logo.svg')}}"
                     alt="logo">
                <div class="ml-[22px]">
                    <h1 class="font-bold xs:text-2xl sm:text-3xl">Blue Grass</h1>
                    <p class="hidden xs:block text-secondary text-[15px]">Арт академия</p>
                </div>
            </div>
        </a>
        <nav class="px-[15px]">
            @include('partials.burger-menu')
            <ul class="hidden space-x-[60px] font-light xl:space-x-[70px] lg:text-xl lg:flex">
                <li><a href="/partners" class="hover:text-lightblue transition-colors">Партнеры</a></li>
                <li><a href="/gallery" class="hover:text-lightblue transition-colors">Галерея</a></li>
                <li><a href="/news" class="hover:text-lightblue transition-colors">Новости</a></li>
            </ul>

            <button id="open_burger" class="lg:hidden flex items-center">
                <img src="{{Vite::asset('resources/images/burger.svg')}}" alt="burger" class="w-[24px] y-[24px]">
            </button>
        </nav>
        <div class="hidden lg:flex">
            <a href="/profile" class="flex">
                <img src="{{Vite::asset('resources/images/profile.svg')}}"
                     class="max-w-[28px] max-y-[28px] lg:max-w-[32px] lg:max-y-[32px]"
                     alt="profile">
            </a>
            <button
                class="bg-lightblue w-[150px] h-[45px] rounded-[5px] ml-[15px] text-white text-[16px] font-medium lg:w-[200px] lg:text-[20px] lg:ml-[36px] btn-hover">
                Задать вопрос
            </button>
        </div>
    </div>
</header>
