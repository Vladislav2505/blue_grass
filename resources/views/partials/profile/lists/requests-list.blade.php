@foreach($requests as $request)
    <article class="flex flex-col gap-3 border border-lightgray rounded-[5px] w-full md:w-[90%] p-5 shadow">
        <div>
            <h3 class="font-medium text-xl mb-1">
                @if($request->status === \App\Enums\RequestStatus::Accepted)
                    {{"Заявка на участие в мероприятии “{$request->event->name}” была одобрена"}}
                @else
                    {{"Заявка на участие в мероприятии “{$request->event->name}” была отклонена"}}
                @endif
            </h3>
            <p class="text-secondary text-[14px] text-right sm:text-left">{{$request->updated_at}}</p>
        </div>
        <p>
            @if($request->status === \App\Enums\RequestStatus::Accepted)
                Мы рады сообщить вам, что ваша заявка на участие в мероприятии “<span
                    class="font-medium">{{{$request->event->name}}}</span>” была одобрена.
            @else
                Мы вынуждены сообщить вам, что ваша заявка на участие в мероприятии “<span
                    class="font-medium">{{{$request->event->name}}}</span>” была отклонена. Если у вас есть какие-то
                вопросы, то вы можете задать его через форму или написать на нашу почту: <span
                    class="font-medium">{{config('site.email')}}</span>
            @endif
        </p>
    </article>
@endforeach
