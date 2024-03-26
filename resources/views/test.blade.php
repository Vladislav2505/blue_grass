<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <!-- Styles -->
    @vite('resources/css/app.css')
</head>
<body class="flex items-center justify-center h-screen">
<div class="flex flex-col min-h-screen bg-gray-100">
    <div class="flex items-center justify-center py-12">
        <div class="w-full max-w-md px-8 py-4 bg-white rounded-lg shadow-lg">
            <div class="mb-4 text-center">
                <h2 class="text-xl font-bold text-gray-700">Арт академия</h2>
            </div>
            <form action="#">
                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">E-Mail</label>
                    <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="yourname@example.com">
                </div>
                <div class="mb-6">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Пароль</label>
                    <input type="password" id="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="••••••••">
                </div>
                <div class="mb-6">
                    <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900">Подтверждение пароля</label>
                    <input type="password" id="confirm-password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="••••••••">
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember-me" class="mr-2 h-4 w-4 text-blue-600 focus:ring-blue-500" checked>
                        <label for="remember-me" class="text-sm font-medium text-gray-900">Я согласен на обработку персональных данных</label>
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit" class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-blue-600 rounded-md hover:bg-blue-700 focus:bg-blue-700 focus:outline-none">Зарегистрироваться</button>
                </div>
            </form>
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-500">У вас уже есть учетная запись? <a href="#" class="text-blue-600 hover:underline">Войти</a></p>
            </div>
        </div>
    </div>
    <div class="flex items-center justify-center mt-8">
        <div class="text-center text-sm text-gray-500">
            <p>© 2024 Blue Grass</p>
            <p>E-mail: crescendo2017@mail.ru</p>
            <p>Тел: +7-960-168-98-83 (Звонки по WhatsApp бесплатно)</p>
        </div>
    </div>
</div>


</body>
</html>
