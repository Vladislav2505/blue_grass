<div id="burger_menu"
     class="hidden fixed translate-x-full transform duration-500 inset-0 bg-lightpink px-[25px] py-[16px] flex-col justify-between">
    <div>
        <div class="flex items-center justify-between mb-[45px]">
            <button id="close_burger"><img src="{{Vite::asset('resources/images/menu/close.svg')}}" alt="close">
            </button>
            <div>
                <a href="/" class="flex">
                    <img src="{{Vite::asset('resources/images/favicon.svg')}}" alt="logo"
                         class="min-w-[50px] min-y-[50px] mr-[8px]">
                    <div>
                        <h2 class="text-main font-bold text-[20px] md:text-[24px]">
                            Blue Grass
                        </h2>
                        <p class="text-secondary font-bold text-[14px] leading-[15px]">Арт академия</p>
                    </div>
                </a>
            </div>
            <a href="/profile"><img src="{{Vite::asset('resources/images/menu/profile.svg')}}" alt="profile"></a>
        </div>

        <ul class="text-secondary text-[24px] space-y-[20px]">
            <li class="px-[10px] py-[5px] hover:bg-[#DCC7C7] transition-colors rounded-[10px]">
                <a href="/" class="flex items-center w-full">
                    <img src="{{Vite::asset('resources/images/menu/main.svg')}}" alt="main"
                         class="mr-[12px] w-[20px] h-[20px]">
                    Главная
                </a>
            </li>
            <li class="border-lightpink bg-lightblue text-white rounded-[5px] px-[10px] py-[10px]">
                <a href="/partners" class="flex items-center w-full">
                    <img src="{{Vite::asset('resources/images/menu/partners.svg')}}" alt="partners"
                         class="mr-[12px] w-[20px] h-[20px]">
                    Партнеры
                </a>
            </li>
            <li class="rounded-[5px] px-[10px] py-[10px] hover:bg-[#DCC7C7] transition-colors">
                <a href="/gallery" class="flex items-center w-full">
                    <img src="{{Vite::asset('resources/images/menu/gallery.svg')}}" alt="gallery"
                         class="mr-[12px] w-[20px] h-[20px]">
                    Галерея
                </a>
            </li>
            <li class="rounded-[5px] px-[10px] py-[10px] hover:bg-[#DCC7C7] transition-colors">
                <a href="/news" class="flex items-center w-full">
                    <img src="{{Vite::asset('resources/images/menu/news.svg')}}" alt="news"
                         class="mr-[12px] w-[20px] h-[20px]">
                    Новости
                </a>
            </li>
        </ul>
    </div>
    <button
        class="bg-lightblue h-[50px] rounded-[5px] text-white font-medium text-[20px] w-full btn-hover">
        Задать вопрос
    </button>
</div>
