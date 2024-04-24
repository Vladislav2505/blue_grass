<x-admin.forms.input-label>
    {{$inputLabel}}
</x-admin.forms.input-label>

<div
    class="p-5 relative pt-1 xl:pt-5 rounded-b-lg xl:rounded-s-none xl:rounded-e-lg">
    <input id="{{$inputName}}" name="{{$inputName}}" type="checkbox" @if($inputIsChecked || old($inputName)) checked @endif
           class="border border-lightgray w-5 h-5 cursor-pointer"/>
</div>
