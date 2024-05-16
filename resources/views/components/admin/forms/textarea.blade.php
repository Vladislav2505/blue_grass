@if($textareaLabel)
    <x-admin.forms.input-label>
        {{$textareaLabel . ($isRequired ? ' *' : '')}}
    </x-admin.forms.input-label>
@endif

<div
    class="p-5 relative pt-1 xl:pt-5 rounded-b-lg xl:rounded-s-none xl:rounded-e-lg">
    <textarea id="{{$textareaName}}" name="{{$textareaName}}" placeholder="{{$textareaPlaceholder}}" class="w-full 2xl:w-[650px] max-h-[650px] h-[300px] border border-lightgray rounded-[5px] p-4 overflow-auto resize-none">{{old($textareaName) ?: $textareaValue}}</textarea>
    <x-admin.forms.input-error :error-name="$textareaName"/>
</div>
