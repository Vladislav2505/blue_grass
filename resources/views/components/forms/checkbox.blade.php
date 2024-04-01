<div class="flex flex-col">
    <div class="flex">
        <input id="{{$checkboxName}}" type="checkbox" class="w-5 rounded-[5px] cursor-pointer"
               name="{{$checkboxName}}" value="true">
        <label id="{{$checkboxName}}-label" for="{{$checkboxName}}}" class="text-[14px] ml-2">
            {{$slot}}
        </label>
    </div>
    <p id="{{$checkboxName}}_error" class="text-red-500 text-[14px]">{{$errors->first($checkboxName)}}</p>
</div>
