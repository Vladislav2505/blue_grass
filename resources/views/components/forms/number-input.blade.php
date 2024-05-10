<div class="flex flex-col">
    <label for="{{$inputName}}" class="font-medium">{{$inputLabel}}{{$isRequired ? ' *' : ''}}</label>
    <input type="number" class="auth_input_text" id="{{$inputName}}" name="{{$inputName}}"
           value="{{$inputValue}}"
           placeholder="{{$inputPlaceholder}}" autocomplete="new-{{$inputName}}"
           min="{{$minNumber}}" max="{{$maxNumber}}">
    <p id="{{$inputName}}_error" class="text-error text-[14px]">{{$errors->first($inputName)}}</p>
</div>
