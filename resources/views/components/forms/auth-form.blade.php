<div class="flex items-center mx-auto my-8">
    <form
        class="flex flex-col items-center mx-2 bg-white py-5 px-6 rounded-[5px] max-w-[390px] sm:py-8 sm:px-28 sm:max-w-[560px]"
        action="{{route($formAction)}}" method="POST">
        @csrf
        {{$slot}}
    </form>
</div>
