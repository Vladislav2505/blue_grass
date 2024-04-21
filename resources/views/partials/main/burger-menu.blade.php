<div id="burger_menu"
     class="hidden fixed translate-x-full transform duration-500 inset-0 bg-lightpink px-[25px] py-[16px] flex-col justify-between">
    <div>
        <div class="flex items-center justify-between mb-[45px]">
            <button id="close_burger"><img src="{{Vite::asset('resources/images/menu/close.svg')}}" alt="close">
            </button>
            <x-main.logo small/>
            <a href="{{route(auth()->user()?->isAdmin() ? \App\Providers\RouteServiceProvider::ADMIN : \App\Providers\RouteServiceProvider::PROFILE)}}">
                <img src="{{Vite::asset('resources/images/profile.svg')}}" alt="profile">
            </a>
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
    <x-main.button button-label="Задать вопрос" class="text-xl"/>
</div>
