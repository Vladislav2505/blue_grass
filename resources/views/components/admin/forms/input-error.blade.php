@if($errors->isNotEmpty())
    @if($errors->first($errorName))
        <p class="text-error text-[14px]">{{$errors->first($errorName)}}</p>
    @endif

    @if($errors->get($errorName . '.*'))
        @foreach($errors->get($errorName . '.*') as $message)
            @if(is_array($message))
                @foreach($message as $subMessage)
                    <p class="text-error text-[12px]">{{$subMessage}}</p>
                @endforeach
            @else
                <p class="text-error text-[12px]">{{$message}}</p>
            @endif
        @endforeach
    @endif
@endif
