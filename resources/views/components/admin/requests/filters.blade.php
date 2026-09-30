@props(['events'])

<details class="rounded-[10px] border border-lightgray" @if(request()->hasAny(['id', 'event_id', 'full_name', 'email', 'phone', 'date_of_birth', 'participants_number', 'created_at', 'status'])) open @endif>
    <summary class="cursor-pointer list-none px-4 py-3 font-medium text-secondary marker:hidden">
        Фильтры
    </summary>
    <form method="GET" action="{{route('admin.requests.index')}}"
          class="grid grid-cols-1 gap-4 border-t border-lightgray p-4 sm:grid-cols-2 xl:grid-cols-3">
    <label class="flex flex-col gap-1 text-sm text-secondary">
        <span>ID</span>
        <input type="number" min="1" name="id" value="{{request('id')}}" placeholder="Любой ID"
               class="rounded-[5px] border border-lightgray px-3 py-2"/>
    </label>
    <label class="flex flex-col gap-1 text-sm text-secondary">
        <span>Мероприятие</span>
        <select name="event_id" class="rounded-[5px] border border-lightgray bg-white px-3 py-2">
            <option value="">Все мероприятия</option>
            @foreach($events as $event)
                <option value="{{$event->id}}" @selected((string) request('event_id') === (string) $event->id)>{{$event->name}}</option>
            @endforeach
        </select>
    </label>
    <label class="flex flex-col gap-1 text-sm text-secondary">
        <span>ФИО</span>
        <input type="text" name="full_name" value="{{request('full_name')}}" placeholder="Поиск по ФИО"
               class="rounded-[5px] border border-lightgray px-3 py-2"/>
    </label>
    <label class="flex flex-col gap-1 text-sm text-secondary">
        <span>Email</span>
        <input type="text" name="email" value="{{request('email')}}" placeholder="Поиск по email"
               class="rounded-[5px] border border-lightgray px-3 py-2"/>
    </label>
    <label class="flex flex-col gap-1 text-sm text-secondary">
        <span>Телефон</span>
        <input type="text" name="phone" value="{{request('phone')}}" placeholder="Поиск по телефону"
               class="rounded-[5px] border border-lightgray px-3 py-2"/>
    </label>
    <label class="flex flex-col gap-1 text-sm text-secondary">
        <span>Дата рождения</span>
        <input type="date" name="date_of_birth" value="{{request('date_of_birth')}}"
               class="rounded-[5px] border border-lightgray px-3 py-2"/>
    </label>
    <label class="flex flex-col gap-1 text-sm text-secondary">
        <span>Количество участников</span>
        <input type="number" min="0" name="participants_number" value="{{request('participants_number')}}"
               class="rounded-[5px] border border-lightgray px-3 py-2"/>
    </label>
    <label class="flex flex-col gap-1 text-sm text-secondary">
        <span>Дата заявки</span>
        <input type="date" name="created_at" value="{{request('created_at')}}"
               class="rounded-[5px] border border-lightgray px-3 py-2"/>
    </label>
    <label class="flex flex-col gap-1 text-sm text-secondary">
        <span>Статус</span>
        <select name="status" class="rounded-[5px] border border-lightgray bg-white px-3 py-2">
            <option value="">Любой статус</option>
            @foreach(\App\Enums\RequestStatus::cases() as $status)
                <option value="{{$status->value}}" @selected((string) request('status') === (string) $status->value)>{{$status->label()}}</option>
            @endforeach
        </select>
    </label>
    <div class="col-span-full flex flex-wrap items-center gap-3">
        <button type="submit" class="inline-flex h-11 min-w-40 items-center justify-center rounded-[5px] bg-blue px-6 !py-0 text-base font-medium leading-none text-white transition-colors hover:bg-darkblue">Применить</button>
        <a href="{{route('admin.requests.index')}}" class="inline-flex h-11 min-w-32 items-center justify-center rounded-[5px] border border-lightgray px-6 !py-0 text-base font-medium leading-none text-secondary transition-colors hover:bg-gray-100">Сбросить</a>
    </div>
    </form>
</details>
