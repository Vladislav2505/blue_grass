<div
    class="px-5 pt-4 md:pt-[27px] md:min-h-[78px] rounded-t-lg md:rounded-e-none md:rounded-s-lg">
    <label for="name" class="font-medium">{{$inputLabel}}</label>
</div>
<div
    class="p-5 relative pt-1 md:pt-5 rounded-b-lg md:rounded-s-none md:rounded-e-lg">
    <input id="{{$inputName}}" name="{{$inputName}}" value="{{old($inputName) ?? $inputValue}}" type="text"
           class="text-secondary border border-lightgray rounded-[5px] px-3 py-2 w-full"
           placeholder="Введите {{Str::lower($inputLabel)}}"/>
    <p class="text-error text-[14px]">{{$errors->first($inputName)}}</p>
</div>
