@extends('layouts.app')
@section('title', 'Восстановление пароля')

@section('content')
    <div class="flex items-center mx-auto my-8">
        <form class="flex flex-col items-center mx-2 bg-white py-5 px-6 rounded-[5px] sm:py-8 sm:px-28" action=""
              method="post">
            <div class="text-center pb-6">
                <h2 class="text-3xl font-bold mb-1 sm:text-5xl">
                    Восстановление<br>пароля
                </h2>
            </div>
            <div class="w-full flex flex-col gap-4">
                <div class="flex flex-col">
                    <label for="email" class="font-medium text-[14px] sm:text-[16px]">E-Mail</label>
                    <input type="email" class="auth_input_text" id="email" name="email"
                           placeholder="Введите E-mail">
                    <p class="text-red-500"></p>
                </div>
                <input type="submit" value="Отправить код" name="submit"
                       class="py-2 bg-lightblue rounded-[5px] text-white font-medium btn-hover cursor-pointer">
            </div>
        </form>
    </div>
@endsection
