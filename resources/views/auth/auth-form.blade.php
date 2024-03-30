@extends('layouts.app')
@section('title', 'Авторизация')

@section('content')
    <div class="flex items-center mx-auto my-8">
        <form class="flex flex-col items-center mx-2 bg-white py-5 px-6 rounded-[5px] sm:py-8 sm:px-28" action=""
              method="post">
            <div class="text-center pb-6">
                <h2 class="text-3xl font-bold mb-1 sm:text-5xl">Авторизация</h2>
                <p class="text-secondary">У вас нет учетной записи? <a href="/" class="text-lightblue">Регистрация</a>
                </p>
            </div>
            <div class="w-full flex flex-col gap-4">
                <div class="flex flex-col">
                    <label for="email" class="font-medium">E-mail</label>
                    <input type="email" class="auth_input_text" id="email" name="email" placeholder="Введите E-mail">
                    <p class="text-red-500"></p>
                </div>
                <div class="flex flex-col">
                    <label for="password" class="font-medium">Пароль</label>
                    <input type="password" class="auth_input_text" id="password" name="password"
                           placeholder="Введите Пароль">
                    <p class="text-red-500"></p>
                </div>
                <div class="flex justify-between">
                    <div class="flex">
                        <input type="checkbox" class="w-5 rounded-[5px]" id="personal-data" name="personal-data">
                        <label for="personal-data" class="text-[14px] ml-2">Запомнить меня</label>
                    </div>
                    <a href="/" class="text-lightblue text-[12px] xs:text-[14px]">Забыли пароль?</a>
                </div>
                <input type="submit" value="Войти"
                       class="py-2 bg-lightblue rounded-[5px] text-white font-medium btn-hover">
            </div>
        </form>
    </div>
@endsection
