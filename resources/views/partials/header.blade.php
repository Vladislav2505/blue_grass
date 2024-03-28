<header class="bg-white">
    <div class="flex justify-between items-center h-[180px] max-w-[1420px] mx-auto px-[25px]">
        <a href="/">
            <div class="flex items-center">
                <img class="object-contain max-w-[140px] lg:max-w-[160px]" src="{{asset('assets/img/logo.svg')}}"
                     alt="logo">
                <div class="ml-[22px]">
                    <h1 class="font-bold text-[24px] md:text-[30px]">Blue Grass</h1>
                    <p class="text-secondary text-[15px]">Арт академия</p>
                </div>
            </div>
        </a>
        <nav class="px-[15px]">
            @include('partials.burger-menu')

            <ul class="hidden lg:flex space-x-[25px] text-[16px] font-light lg:space-x-[70px] lg:text-[20px]">
                <li><a href="/partners">Партнеры</a></li>
                <li><a href="/gallery">Галерея</a></li>
                <li><a href="/news">Новости</a></li>
            </ul>

            <button id="burger" class="inline-block lg:hidden">
                <img src="{{asset('assets/img/burger.svg')}}" alt="burger" class="md:w-[24px] md:y-[24px]">
            </button>
        </nav>
        <div class="hidden lg:flex">
            <a href="/profile" class="flex">
                <img src="{{asset('assets/img/profile.svg')}}"
                     class="max-w-[28px] max-y-[28px] lg:max-w-[32px] lg:max-y-[32px]"
                     alt="profile">
            </a>
            <button
                class="bg-lightblue w-[150px] h-[45px] rounded-[5px] ml-[15px] text-white text-[16px] font-medium lg:w-[200px] lg:text-[20px] lg:ml-[36px]">
                Задать вопрос
            </button>
        </div>
    </div>
</header>
