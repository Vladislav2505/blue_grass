<div id="sidebar_background" class="hidden fixed inset-0 bg-opacity-100 z-50"></div>
<aside id="sidebar"
       class="custom-scrollbar hidden z-50 fixed -translate-x-full transform duration-500 xl:flex xl:translate-x-0 xl:static xl:duration-0 h-screen">
    <div id="12" class="flex flex-col bg-darkblue text-white px-5 py-3 gap-6 w-72">
        <x-main.logo small/>

        <div class="overflow-y-auto w-full pt-1">
            <nav class="flex flex-col gap-5 justify-center">
                @foreach(config('menu.admin') as $url => $point)
                    @if(is_array($point) && array_key_exists('items', $point))
                        <div>
                            <div
                                class="{{Str::contains($currentUrl, $url) ? 'bg-[#495270]' : 'bg-[#3c486c] hover:bg-[#495270]'}} p-2 rounded-t-[5px] transition-colors">
                                <a href="/admin/{{$url}}" class="flex items-center gap-2">
                                    <img src="{{Vite::asset("resources/images/admin/menu/$url.svg")}}" alt="{{$url}}"/>
                                    <h2>{{$point['name']}}</h2>
                                </a>
                            </div>
                            <div class="bg-[#25335b] rounded-b-[5px]">
                                <ul class="text-[14px] font-light">
                                    @foreach($point['items'] as $childUrl => $childLabel)
                                        <li class="{{Str::contains($currentUrl, $childUrl) ? 'bg-[#495270]' : 'hover:bg-[#495270]'}} pl-7 transition-colors rounded-[2px]">
                                            <a href="/admin/{{$childUrl}}" class="p-2 block">
                                                {{$childLabel}}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @else
                        <div>
                            <ul class="space-y-3">
                                <li class="{{Str::contains($currentUrl, $url) ? "bg-[#495270]" : 'hover:bg-[#495270]'}}  rounded-[5px] transition-colors">
                                    <a href="/admin/{{$url}}" class="flex items-center w-full p-3 gap-2">
                                        <img src="{{Vite::asset("resources/images/admin/menu/$url.svg")}}"
                                             alt="{{$url}}"/>
                                        {{$point}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endif
                @endforeach
            </nav>
        </div>

    </div>
    <div class="block xl:hidden m-2">
        <button id="close_sidebar">
            <img src="{{Vite::asset('resources/images/admin/close.svg')}}" class="w-[36px]" alt="close">
        </button>
    </div>
</aside>
