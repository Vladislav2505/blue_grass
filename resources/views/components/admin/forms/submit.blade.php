<input id="{{$submitId ?: $submitName}}" name="{{$submitName}}" value="{{$submitLabel}}"
       type="submit" {{$attributes->merge(['class' => 'bg-blue rounded-[5px] text-white font-medium py-3 px-3 hover:bg-darkblue transition-colors cursor-pointer'])}}>
