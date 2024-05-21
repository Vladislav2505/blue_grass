<div id="{{$attributes->get('modalId')}}"
     class="w-full h-full mx-auto fixed inset-0 bg-black bg-opacity-20 items-center justify-center z-[9999] hidden transition-opacity duration-300">
    <div
        class="flex flex-col max-h-full bg-white rounded-[5px] shadow-lg opacity-0 transform scale-95 transition-all duration-300 mx-0 md:mx-4 w-full h-full md:h-fit md:w-[500px]">
        <div class="flex flex-row justify-between items-center px-5 py-4 border-b border-lightgray">
            <h3 class="font-medium text-xl">{{$attributes->get('title')}}</h3>
            <button id="{{$attributes->get('modalId') . 'Close'}}">
                <img src="{{Vite::asset('resources/images/menu/close.svg')}}" alt="close" class="w-[18px]">
            </button>
        </div>
        {{$slot}}
    </div>
</div>
