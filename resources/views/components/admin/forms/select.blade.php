@php
    if (old($selectName)) {
        $old = old($selectName);

        if (is_array($old)){
            $selectedOptions = collect($old)->values();
        } else {
            $selectedOptions = collect($old);
        }
    }
@endphp

<x-admin.forms.input-label>
    {{$selectLabel . ($isRequired ? ' *' : '')}}
</x-admin.forms.input-label>

@if($isMultiple)
    <div
            class="p-5 relative pt-1 xl:pt-5 rounded-b-lg xl:rounded-s-none xl:rounded-e-lg">
        <select name="{{$selectName}}[]" multiple
                class="border border-lightgray focus:outline-none text-secondary rounded-[5px] h-fit w-full md:w-60">
            @foreach($selectOptions as $option)
                <option value="{{$option->id}}" @if($selectedOptions?->contains($option->id)) selected @endif>
                    {{$option->name}}
                </option>
            @endforeach
        </select>
        <p class="text-error text-[14px]">{{$errors->first($selectName)}}</p>
    </div>
@else
    <div
            class="p-5 relative pt-1 xl:pt-5 rounded-b-lg xl:rounded-s-none xl:rounded-e-lg">
        <select name="{{$selectName}}"
                class="border border-lightgray focus:outline-none text-secondary rounded-[5px] h-11 w-full md:w-60">
            @foreach($selectOptions as $option)
                <option value="{{$option->id}}" @if($selectedOptions?->contains($option->id)) selected @endif>
                    {{$option->name}}
                </option>
            @endforeach
        </select>
        <p class="text-error text-[14px]">{{$errors->first($selectName)}}</p>
    </div>
@endif
