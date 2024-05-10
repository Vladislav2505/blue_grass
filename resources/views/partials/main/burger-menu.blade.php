<div id="burger_menu"
     class="hidden fixed translate-x-full transform duration-500 inset-0 bg-lightpink px-[25px] py-[16px] flex-col justify-between custom-scrollbar z-9999">
    <div class="relative mb-4">
        <div class="flex items-center justify-between mb-[45px]">
            <button id="close_burger">
                <img src="{{Vite::asset('resources/images/menu/close.svg')}}" alt="close">
            </button>
            <x-main.logo small/>

            <div>
                <a href="{{route(auth()->user()?->isAdmin() ? \App\Providers\RouteServiceProvider::ADMIN : \App\Providers\RouteServiceProvider::PROFILE)}}"
                   class="{{Request::is('profile') ? 'hidden' : ''}}">
                    <img src="{{Vite::asset('resources/images/profile.svg')}}" alt="profile">
                </a>
            </div>
        </div>

        <ul class="text-secondary text-[24px] space-y-[20px] overflow-y-auto max-h-[64vh]">
            @foreach(config('menu.main') as $url => $point)
                @php($isSelected = Str::contains($currentUrl, $url))
                <li
                    class="{{$isSelected ? 'border-lightpink bg-lightblue text-white' : 'hover:bg-[#DCC7C7] transition-colors'}}
                    rounded-[5px] px-[10px] py-[10px]">
                    <a href="/{{$url}}" class="flex flex-row items-center gap-4">
                        <img
                            src="{{Vite::asset("resources/images/menu/$url" . ($isSelected ? '-selected' : '') . '.svg')}}"
                            alt="{{$url}}">
                        <p>{{$point}}</p>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    @if(! Request::is('profile'))
        <div class="flex justify-end">
            <button class="question-modal-open">
                <img src="{{Vite::asset('resources/images/question.svg')}}" alt="question" class="object-contain">
            </button>
        </div>
    @endif
</div>
