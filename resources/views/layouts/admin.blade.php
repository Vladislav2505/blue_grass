@php
    $currentUrl = url()->current();
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{Vite::asset('resources/images/logo.svg')}}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>@yield('title') - {{config('app.name')}}</title>

    <!-- Styles -->
    @vite(['resources/js/app.js', 'resources/js/admin.js'])
</head>
<body class="bg-white">
<div id="wrapper" class="flex flex-row justify-between h-full w-full">
    @include('partials.admin.sidebar')

    <div class="flex-grow">
        @include('partials.admin.header')

        <main>
            <div class="mx-9 my-10 px-6 py-8 border-2 shadow rounded-[5px]">
                @yield('content')
            </div>
        </main>
    </div>
</div>
</body>
</html>
