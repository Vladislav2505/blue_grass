<div class="flex flex-row gap-6 items-center justify-center">
    @if($isUpdatable ?? false)
        <div>
            <a href="{{route("admin.{$model->getTable()}.edit", [rtrim($model->getTable(), 's') => $model->slug])}}">
                <button>
                    <img src="{{Vite::asset('resources/images/admin/update.svg')}}" alt="update">
                </button>
            </a>
        </div>
    @endif

    @if($isDeletable ?? false)
        <form
            action="{{route("admin.{$model->getTable()}.destroy", [rtrim($model->getTable(), 's') => $model->slug])}}"
            method="POST">
            @csrf
            @method('DELETE')
            <button type="button" class="delete-button">
                <img src="{{Vite::asset('resources/images/admin/delete.svg')}}" alt="delete">
            </button>
        </form>
    @endif
</div>
