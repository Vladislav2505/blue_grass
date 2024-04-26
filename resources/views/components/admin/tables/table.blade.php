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
    <x-admin.delete-modal/>
</div>
