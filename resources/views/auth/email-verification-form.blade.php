@extends('layouts.app')
@section('title', 'Регистрация')

@section('content')
    <div class="flex items-center mx-auto my-8">
        <form class="flex flex-col items-center mx-2 bg-white py-5 px-10 rounded-[5px] sm:py-8 sm:px-28" action=""
              method="post">
            <div class="text-center pb-6">
                <h2 class="text-3xl font-bold mb-1 sm:text-5xl">Верификация</h2>
            </div>
            <div class="w-full flex flex-col gap-4">
                <div class="flex flex-col">
                    <label for="email_ver" class="font-medium text-[14px] sm:text-[16px]">Код отправлен на test@mail.com</label>
                    <input type="text" class="auth_input_text" id="email_ver" name="email_ver"
                           placeholder="Введите код из письма">
                    <p class="text-red-500"></p>
                </div>
                <div class="flex flex-col items-start text-[14px] text-lightblue gap-2">
                    <input type="submit" value="Отправить код повторно" name="send_again" class="cursor-pointer">
                    <a href="/">Сменить почту</a>
                </div>
                <input type="submit" value="Подтвердить" name="submit"
                       class="py-2 bg-lightblue rounded-[5px] text-white font-medium btn-hover cursor-pointer">
            </div>
        </form>
    </div>
@endsection
