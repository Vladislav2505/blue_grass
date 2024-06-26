@php
    if (empty($urlParam)) {
        $urlParam = rtrim($model->getTable(), 's');
    }
@endphp

<div class="flex flex-row gap-6 items-center justify-center">
    @if($isUpdatable ?? false)
        <div>
            <a href="{{route("admin.{$model->getTable()}.edit", [$urlParam => $model->slug ?? $model])}}">
                <button>
                    <img src="{{Vite::asset('resources/images/admin/update.svg')}}" alt="update">
                </button>
            </a>
        </div>
    @endif

    @if($isViewable ?? false)
        <div>
            <a href="{{route("admin.{$model->getTable()}.show", [$urlParam => $model->slug ?? $model])}}">
                <button>
                    <img src="{{Vite::asset('resources/images/admin/show.svg')}}" alt="show">
                </button>
            </a>
        </div>
    @endif

    @if($isDeletable ?? false)
        <form
            action="{{route("admin.{$model->getTable()}.destroy", [$urlParam => $model->slug ?? $model])}}"
            method="POST">
            @csrf
            @method('DELETE')
            <button type="button" class="delete-button">
                <img src="{{Vite::asset('resources/images/admin/delete.svg')}}" alt="delete">
            </button>
        </form>
    @endif
</div>
