@extends('layouts.app')
@section('title', 'Регистрация')
@vite('resources/js/forms/registration.js')

@section('content')
    <div class="flex items-center mx-auto my-8">
        <form
            class="flex flex-col items-center mx-2 bg-white py-5 px-6 rounded-[5px] max-w-[390px] sm:py-8 sm:px-28 sm:max-w-[560px]"
            action="{{route('register')}}" method="post">
            @csrf
            <div class="text-center pb-6">
                <h2 class="text-3xl font-bold mb-1 sm:text-5xl">Регистрация</h2>
                <p class="text-secondary">У вас уже есть учетная запись? <a href="/" class="text-lightblue">Войти</a>
                </p>
            </div>
            <div class="w-full flex flex-col gap-4">
                <div class="flex flex-col">
                    <label for="last_name" class="font-medium">Фамилия</label>
                    <input type="text" class="auth_input_text" id="last_name" name="last_name"
                           value="{{old('last_name')}}"
                           placeholder="Введите Фамилию" autocomplete="new-last-name">
                    <p id="last_name_error" class="text-red-500 text-[14px]">{{$errors->first('last_name')}}</p>
                </div>
                <div class="flex flex-col">
                    <label for="first_name" class="font-medium">Имя</label>
                    <input type="text" class="auth_input_text" id="first_name" name="first_name"
                           value="{{old('first_name')}}"
                           placeholder="Введите Имя" autocomplete="new-first-name">
                    <p id="first_name_error"
                       class="text-red-500 text-[14px] w-full">{{$errors->first('first_name')}}</p>
                </div>
                <div class="flex flex-col">
                    <label for="email" class="font-medium">E-mail</label>
                    <input type="text" class="auth_input_text" id="email" name="email" value="{{old('email')}}"
                           placeholder="Введите E-mail" autocomplete="new-email">
                    <p id="email_error" class="text-red-500 text-[14px]">{{$errors->first('email')}}</p>
                </div>
                <div class="flex flex-col">
                    <label for="password" class="font-medium">Пароль</label>
                    <input type="password" class="auth_input_text" id="password" name="password"
                           placeholder="Введите Пароль" autocomplete="new-password">
                    <p id="password_error" class="text-red-500 text-[14px]">{{$errors->first('password')}}</p>
                </div>
                <div class="flex flex-col">
                    <label for="password_confirmation" class="font-medium">Подтверждения пароля</label>
                    <input type="password" class="auth_input_text" id="password_confirmation"
                           name="password_confirmation"
                           placeholder="Подтвердите пароль" autocomplete="new-password">
                </div>
                <div class="flex flex-col">
                    <div class="flex">
                        <input id="personal-data" type="checkbox" class="w-5 rounded-[5px] cursor-pointer"
                               name="personal-data" value="true">
                        <label id="personal-data-label" for="personal-data" class="text-[14px] ml-2">
                            Я согласен на обработку <a href="/" class="text-lightblue">персональных данных</a>
                        </label>
                    </div>
                    <p id="personal-data_error" class="text-red-500 text-[14px]">{{$errors->first('personal-data')}}</p>
                </div>
                <input type="submit" value="Зарегистрироваться"
                       class="py-2 bg-lightblue rounded-[5px] text-white font-medium btn-hover cursor-pointer">
            </div>
        </form>
    </div>
@endsection
