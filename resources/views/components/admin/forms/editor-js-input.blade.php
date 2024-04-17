<x-admin.forms.input-label>
    {{$inputLabel}}
</x-admin.forms.input-label>

<div
    class="p-3 relative pt-1 xl:pt-5 rounded-b-lg xl:rounded-s-none xl:rounded-e-lg overflow-hidden max-w-full">
    <div class="w-full 2xl:w-[650px] max-h-[650px] border border-lightgray rounded-[5px] px-5 overflow-auto">
        <input type="hidden" id="editorData" name="{{$inputName}}">
        <div id="editorjs" data="{{old($inputName) ?? $editorData}}"></div>
    </div>
</div>
