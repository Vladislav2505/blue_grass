@extends('layouts.main')
@section('title', 'Профиль')

@section('content')
    <h2 class="text-center font-medium text-3xl">Профиль</h2>
    <div class="flex flex-col gap-4">
        @if(session('success'))
            <span class="text-success break-words">{{session('success')}}</span>
        @elseif($errors->first('error'))
            <span class="text-error break-words">{{$errors->first('error')}}</span>
        @endif
        <div id="listContent" class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-5 sm:gap-10">
            <div class="border border-lightgray rounded-[5px]">
                <a href="{{route('profile.edit')}}" class="flex flex-row justify-start gap-6 px-6 py-4">
                    <div class="bg-lightblue rounded-[5px] p-3 w-fit h-fit">
                        <img src="{{Vite::asset('resources/images/profile/profile-data.svg')}}" alt="data"
                             class="object-contain">
                    </div>
                    <div class="flex flex-col gap-2">
                        <h3 class="font-medium text-xl">Личные данные</h3>
                        <p class="text-secondary">Редактирование личных данных</p>
                    </div>
                </a>
            </div>
            <div class="border border-lightgray rounded-[5px]">
                <a href="{{route('profile.notifications.requests')}}" class="flex flex-row justify-start gap-6 px-6 py-4">
                    <div class="bg-lightblue rounded-[5px] p-3 w-fit h-fit">
                        <img src="{{Vite::asset('resources/images/profile/notification.svg')}}" alt="notification"
                             class="object-contain">
                    </div>
                    <div class="flex flex-col gap-2">
                        <h3 class="font-medium text-xl">Уведомления</h3>
                        <p class="text-secondary">Результаты заявок и ответы на вопросы</p>
                    </div>
                </a>
            </div>
            <div class="border border-lightgray rounded-[5px]">
                <a href="{{route('profile.security')}}" class="flex flex-row justify-start gap-6 px-6 py-4">
                    <div class="bg-lightblue rounded-[5px] p-3 w-fit h-fit">
                        <img src="{{Vite::asset('resources/images/profile/security.svg')}}" alt="security"
                             class="object-contain">
                    </div>
                    <div class="flex flex-col gap-2">
                        <h3 class="font-medium text-xl">Безопасность</h3>
                        <p class="text-secondary">Настройка безопасности учетной записи</p>
                    </div>
                </a>
            </div>
        </div>
        <form method="POST" action="{{route('logout')}}" class="ml-2">
            @csrf
            <button type="submit" class="text-error">
                Выйти из аккаунта
            </button>
        </form>
    </div>
@endsection
