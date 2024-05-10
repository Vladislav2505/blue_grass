<x-admin.forms.input-label>
    {{$inputLabel . ($isRequired ? ' *' : '')}}
</x-admin.forms.input-label>

<div
    class="p-5 relative pt-1 xl:pt-5 rounded-b-lg xl:rounded-s-none md:rounded-e-lg">
    <input id="{{$inputName}}" name="{{$inputName}}" value="{{old($inputName) ?? $inputValue}}" type="date"
           class="text-secondary border border-lightgray rounded-[5px] px-3 py-2 w-full md:w-60" min="{{$minNumber}}" max="{{$maxNumber}}"/>
    <p class="text-error text-[14px]">{{$errors->first($inputName)}}</p>
</div>
