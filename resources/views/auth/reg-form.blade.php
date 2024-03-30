@extends('layouts.app')
@section('title', 'Регистрация')

@section('content')
    <div class="flex items-center mx-auto my-8">
        <form class="flex flex-col items-center mx-2 bg-white py-5 px-6 rounded-[5px] sm:py-8 sm:px-28" action="" method="post">
            <div class="text-center pb-6">
                <h2 class="text-3xl font-bold mb-1 sm:text-5xl">Регистрация</h2>
                <p class="text-secondary">У вас уже есть учетная запись? <a href="/" class="text-lightblue">Войти</a>
                </p>
            </div>
            <div class="w-full flex flex-col gap-4">
                <div class="flex flex-col">
                    <label for="full_name" class="font-medium">ФИО</label>
                    <input type="text" class="auth_input_text" id="full_name" name="full_name"
                           placeholder="Введите ФИО">
                    <p class="text-red-500"></p>
                </div>
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
                <div class="flex flex-col">
                    <label for="password-confirm" class="font-medium">Подтверждения пароля</label>
                    <input type="password" class="auth_input_text" id="password-confirm" name="password-confirm"
                           placeholder="Подтвердите пароль">
                    <p class="text-red-500"></p>
                </div>
                <div class="flex">
                    <input type="checkbox" class="w-5 rounded-[5px]" id="personal-data" name="personal-data">
                    <label for="personal-data" class="text-[14px] ml-2">Я согласен на обработку персональных
                        данных</label>
                </div>
                <input type="submit" value="Зарегистрироваться" class="py-2 bg-lightblue rounded-[5px] text-white font-medium btn-hover">
            </div>
        </form>
    </div>
@endsection
