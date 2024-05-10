<div class="break-words">
    @foreach($blocks as $block)
        @switch($block['type'])
            @case('paragraph')
                <p style="@if(isset($block['data']['alignment'])) text-align: {{$block['data']['alignment']}} @endif">
                    {!! $block['data']['text'] !!}
                </p>
                @break
            @case('delimiter')
                <div class="mt-4 mb-2">
                    <p class="text-center font-medium text-3xl tracking-[10px]">***</p>
                </div>
                @break
            @case('list')
                @if($block['data']['style'] === 'ordered')
                    <br>
                    <ol style="list-style: auto" class="pl-4 my-2">
                        @foreach($block['data']['items'] as $li)
                            <li>{{$li}}</li>
                        @endforeach
                    </ol>
                    <br>
                @elseif($block['data']['style'] === 'unordered')
                    <ul style="list-style: inside" class="my-2">
                        @foreach($block['data']['items'] as $li)
                            <li>{{$li}}</li>
                        @endforeach
                    </ul>
                @endif
                @break
        @endswitch
        <br>
    @endforeach
</div>
