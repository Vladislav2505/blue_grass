@extends('layouts.main')
@section('title', 'Профиль')

@section('content')
    <h2 class="text-center font-medium text-3xl">Профиль</h2>
    <div class="flex flex-col gap-4">
        <div id="listContent" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-5 sm:gap-10">
            <div class="border border-lightgray rounded-[5px]">
                <a href="/" class="flex flex-row justify-start gap-6 px-6 py-4">
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
                <a href="/" class="flex flex-row justify-start gap-6 px-6 py-4">
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
                <a href="/" class="flex flex-row justify-start gap-6 px-6 py-4">
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
        </div>
        <form method="POST" action="{{route('logout')}}" class="ml-2">
            @csrf
            <button type="submit" class="text-error">
                Выйти из аккаунта
            </button>
        </form>
    </div>
@endsection
