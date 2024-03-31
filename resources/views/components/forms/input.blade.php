<div class="flex flex-col">
    <label for="{{$inputName}}" class="font-medium">{{$inputLabel}}</label>
    <input type="{{$inputType}}" class="auth_input_text" id="{{$inputName}}" name="{{$inputName}}"
           value="{{old($inputName)}}"
           placeholder="{{$inputPlaceholder}}" autocomplete="new-{{$inputName}}">
    <p id="{{$inputName}}_error" class="text-red-500 text-[14px]">{{$errors->first($inputName)}}</p>
</div>
