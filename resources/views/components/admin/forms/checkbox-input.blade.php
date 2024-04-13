<div
    class="px-5 pt-4 md:pt-[27px] md:min-h-[78px] rounded-t-lg md:rounded-e-none md:rounded-s-lg">
    <label for="is_active" class="font-medium">{{$inputLabel}}</label>
</div>
<div
    class="p-5 relative pt-1 md:pt-5 rounded-b-lg md:rounded-s-none md:rounded-e-lg">
    <input id="{{$inputName}}" name="{{$inputName}}" value="true" type="checkbox" @if($inputIsChecked) checked @endif
           class="border border-lightgray w-5 h-5 cursor-pointer"/>
</div>
