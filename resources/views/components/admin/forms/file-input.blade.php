<x-admin.forms.input-label>
    {{$inputLabel . ($isRequired ? ' *' : '')}}
</x-admin.forms.input-label>

<div
    class="flex flex-col gap-2 p-5 relative pt-1 xl:pt-5 rounded-b-lg xl:rounded-s-none xl:rounded-e-lg">
    <input id="loadedFile" type="hidden" name="loadedFile" value="{{$inputValue['filePath']}}">
    <div
        class="flex flex-col items-center border border-lightgray rounded-[5px] border-dashed p-4 w-full md:w-60">
        <input id="fileInput" type="file"
               name="{{$inputName}}" class="hidden" accept="{{$inputAccept}}"/>
        <label for="fileInput" class="text-[14px] text-secondary cursor-pointer mx-auto text-center">
            <span class="text-blue">Загрузите файл</span><br> до 10 МБ
        </label>
    </div>
    <div id="fileList">
        @if($inputValue)
            <p class="text-secondary">{{$inputValue['fileName']}}</p>
        @endif
    </div>
    <p class="text-error text-[14px]">{{$errors->first($inputName)}}</p>
</div>
