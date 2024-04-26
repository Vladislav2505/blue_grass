@if(session('success'))
    <span class="text-success break-words">{{session('success')}}</span>
@elseif($errors->first('error'))
    <span class="text-error break-words">{{$errors->first('error')}}</span>
@endif
<div class="border border-lightgray rounded-[10px] overflow-x-auto overflow-y-hidden">
    <table class="table-auto w-full whitespace-nowrap max-w-none text-secondary text-left text-[12px] md:text-[16px]">
        <thead class="border-b border-[#d1d5db]">
        <tr>
            @foreach($tableHeaders as $header)
                <th class="px-6 py-2">{{$header}}</th>
            @endforeach
            <th class="px-6 py-2 text-center">Действия</th>
        </tr>
        </thead>
        <tbody>
        {{$slot}}
        </tbody>
    </table>

    <div id="modalOverlay" class="mx-auto fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 hidden transition-opacity duration-300">
        <div class="mx-4 bg-white rounded-[5px] shadow-lg w-96 opacity-0 transform scale-95 transition-all duration-300">
            <div class="p-4 border-b">
                <h2 class="text-lg font-medium">Подтвердите удаление</h2>
            </div>
            <div class="p-4">
                <p>Вы уверены, что хотите удалить элемент?</p>
            </div>
            <div class="p-4 border-t">
                <button id="confirmDeleteButton" class="px-4 py-2 bg-error text-white rounded hover:bg-red-600 mr-2 transition-colors">Удалить</button>
                <button id="cancelDeleteButton" class="px-4 py-2 bg-white border border-lightgray text-secondary rounded">Отмена</button>
            </div>
        </div>
    </div>

</div>
