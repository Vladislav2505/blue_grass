<footer class="bg-white w-full shadow border-lightgray">
    <div class="py-5 px-10 flex flex-col items-center max-w-[1420px] mx-auto md:flex-row md:justify-between md:px-6">
        <div>
            <a href="{{route(\App\Providers\RouteServiceProvider::HOME)}}"
               class="text-2xl font-bold lg:text-3xl">{{config('site.name')}}</a>
        </div>
        <div class="text-[14px] font-light my-7 flex flex-col items-center text-center lg:text-[18px]">
            <p class="w-full text-center">E-mail: {{config('site.email')}}</p>
            <p class="w-full text-center">Тел: {{config('site.phone')}} (Звонки по WhatsApp бесплатно)</p>
        </div>
        <div class="max-w-xl">
            <div class="flex justify-center items-center space-x-10 mb-[16px] md:justify-end">
                <a href="{{config('site.vk')}}" target="_blank">
                    <img src="{{Vite::asset('resources/images/vk.svg')}}" alt="vk"
                         class="min-w-[35px] lg:min-w-[40px]">
                </a>
                <a href="{{config('site.tg')}}" target="_blank">
                    <img src="{{Vite::asset('resources/images/tg.svg')}}" alt="tg"
                         class="min-w-[35px] lg:min-w-[40px]">
                </a>
            </div>
            <div>
                <a href="/"
                   class="text-[14px] text-secondary font-light hover:text-[#a29999] text-right lg:text-[18px]">Политика
                    конфиденциальности</a>
            </div>
        </div>
    </div>
</footer>
