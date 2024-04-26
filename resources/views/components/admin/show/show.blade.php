<div class="grid grid-cols-1 sm:grid-cols-[minmax(200px,420px)_auto]">
    {{$slot}}
</div>
<div class="flex flex-row justify-end gap-3">
    <x-admin.show.delete-button :model="$model"/>
    <a href="{{route($formBackUrl)}}">
        <x-admin.button button-label="Назад"
                        class="bg-white border border-lightgray !text-secondary hover:bg-white !px-5"/>
    </a>
</div>
