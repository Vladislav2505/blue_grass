<form class="flex flex-col" method="POST" action="{{route($formAction, $formActionParam)}}" enctype="multipart/form-data">
    @method($formMethod)
    @csrf

    <div class="grid grid-cols-1 xl:grid-cols-[minmax(200px,420px)_auto]">
        {{$slot}}
    </div>
    <div class="flex flex-row justify-end gap-3">
        <a href="{{route($formBackUrl)}}">
            <x-admin.button button-label="Отмена"
                            class="bg-white border border-lightgray !text-secondary hover:bg-white"/>
        </a>
        <x-admin.forms.submit submit-label="Сохранить" submit-name="save"/>
    </div>
</form>
