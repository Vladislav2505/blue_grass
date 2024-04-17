<x-admin.forms.input-label>
    {{$inputLabel . ($isRequired ? ' *' : '')}}
</x-admin.forms.input-label>

<div
    class="p-5 relative pt-1 xl:pt-5 rounded-b-lg xl:rounded-s-none xl:rounded-e-lg">
    <input id="{{$inputName}}" name="{{$inputName}}" value="{{old($inputName) ?? $inputValue}}" type="text"
           class="text-secondary border border-lightgray rounded-[5px] px-3 py-2 w-full"
           placeholder="Введите {{Str::lower($inputLabel)}}" {{$isRequired ? 'required' : ''}}/>
    <p class="text-error text-[14px]">{{$errors->first($inputName)}}</p>
</div>
