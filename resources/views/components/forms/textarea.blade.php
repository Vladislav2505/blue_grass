<div class="flex flex-col">
    <label for="{{$textareaLabel}}" class="font-medium">{{$textareaLabel}}{{$isRequired ? ' *' : ''}}</label>
    <textarea name="{{$textareaName}}" placeholder="{{$textareaPlaceholder}}" class="py-2 px-2 rounded-[5px] border border-[#b6b6b6] font-light resize-none h-[170px]">{{$textareaValue}}</textarea>
    <p id="{{$textareaName}}_error" class="text-error text-[14px]">{{$errors->first($textareaName)}}</p>
</div>
