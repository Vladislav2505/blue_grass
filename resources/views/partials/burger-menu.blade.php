<div id="burger_menu"
     class="hidden fixed inset-0 bg-lightpink px-[25px] py-[16px] hidden:flex flex-col justify-between">
    <div>
        <div class="flex items-center justify-between mb-[45px]">
            <button><img src="{{asset('assets/img/menu/close.svg')}}" alt="close"></button>
            <div>
                <a href="/" class="flex">
                    <img src="{{asset('assets/img/favicon.svg')}}" alt="logo"
                         class="min-w-[50px] min-y-[50px] mr-[8px]">
                    <div>
                        <h2 class="text-main font-bold text-[20px] md:text-[24px]">
                            Blue Grass
                        </h2>
                        <p class="text-secondary font-bold text-[14px] leading-[15px]">Арт академия</p>
                    </div>
                </a>
            </div>
            <a href="/profile"><img src="{{asset('assets/img/menu/profile.svg')}}" alt="profile"></a>
        </div>

        <ul class="text-secondary text-[24px] space-y-[20px]">
            <li class="flex items-center rounded-[5px] px-[10px] py-[8px]">
                <img src="{{asset('assets/img/menu/main.svg')}}" alt="main" class="mr-[12px] w-[20px] h-[20px]">
                <a href="/">Главная</a></li>
            <li class="flex items-center border-lightpink bg-lightblue text-white rounded-[5px] px-[10px] py-[8px]">
                <img src="{{asset('assets/img/menu/partners.svg')}}" alt="partners"
                     class="mr-[12px] w-[20px] h-[20px]">
                <a href="/partners">Партнеры</a></li>
            <li class="flex items-center rounded-[5px] px-[10px] py-[8px]">
                <img src="{{asset('assets/img/menu/gallery.svg')}}" alt="gallery"
                     class="mr-[12px] w-[20px] h-[20px]">
                <a href="/gallery">Галерея</a></li>
            <li class="flex items-center rounded-[5px] px-[10px] py-[8px]">
                <img src="{{asset('assets/img/menu/news.svg')}}" alt="news" class="mr-[12px] w-[20px] h-[20px]">
                <a href="/news">Новости</a></li>
        </ul>
    </div>
    <button
        class="bg-lightblue h-[50px] rounded-[5px] text-white font-medium text-[20px] w-full">
        Задать вопрос
    </button>
</div>
