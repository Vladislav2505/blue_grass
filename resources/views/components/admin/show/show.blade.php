<div class="w-full grid grid-cols-1 sm:grid-cols-[minmax(200px,420px)_auto]">
    {{$slot}}
</div>
<div class="flex flex-col sm:flex-row justify-end gap-3">
    @php
        $urlParam = rtrim($model->getTable(), 's');
    @endphp
    <div class="flex flex-row gap-1">
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

        <a href="{{route($formBackUrl)}}">
            <x-admin.button button-label="Назад"
                            class="bg-white border border-lightgray !text-secondary hover:bg-white !px-5"/>
        </a>
    </div>
</div>
