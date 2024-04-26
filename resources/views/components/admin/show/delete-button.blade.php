@php
    $urlParam = rtrim($model->getTable(), 's');
@endphp

<form
    action="{{route("admin.{$model->getTable()}.destroy", [$urlParam => $model->slug ?? $model])}}"
    method="POST">
    @csrf
    @method('DELETE')
    <button type="button"
            class="rounded-[5px] text-white bg-error hover:bg-red-600 font-medium py-3 px-3 transition-colors delete-button">
        Удалить
    </button>
</form>
<x-admin.delete-modal/>
