<x-admin.forms.input-label>
    {{$inputLabel . ($isRequired ? ' *' : '')}}
</x-admin.forms.input-label>

<div
    class="flex flex-col gap-2 p-5 relative pt-1 xl:pt-5 rounded-b-lg xl:rounded-s-none xl:rounded-e-lg">
    <div
        class="flex flex-col items-center border border-lightgray rounded-[5px] border-dashed p-4 w-full">
        <input id="imageInput" {{$isMultiple ? 'multiple' : ''}} type="file"
               name="{{$inputName . ($isMultiple ? '[]' : '')}}" class="hidden" accept="{{$inputAccept}}"/>
        <div id="fileList" class="flex flex-wrap gap-2">
            @foreach($inputValue as $src)
                @if($src)
                    <div class="relative w-24 h-24 md:w-48 md:h-48 mr-2 mb-2">
                        <img class="loaded-image w-full h-full object-cover"
                             src="{{$src}}" alt="img"/>
                        <button
                            class="delete-image-button absolute top-0 right-0 rounded m-2 text-secondary text-center">✖
                        </button>
                    </div>
                @endif
            @endforeach
        </div>
        <label for="imageInput" class="text-[14px] text-secondary cursor-pointer mx-auto text-center">
            <span class="text-blue">Загрузите файл</span> до 10 МБ
        </label>
    </div>
    <p class="text-error text-[14px]">{{$errors->first($inputName)}}</p>
</div>
