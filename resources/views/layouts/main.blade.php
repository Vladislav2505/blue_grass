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
    <title>@yield('title') @if (!empty(trim($__env->yieldContent('title'))) ) - @endif {{config('app.name')}}</title>
    <!-- Styles -->
    @vite(['resources/js/app.js', 'resources/js/main.js'])
</head>
<body class="bg-lightpink h-full w-full">
<div class="wrapper">
    @include('partials.main.header')
    <main class="main">
        <div class="mx-3">
            <div class="container flex flex-col justify-between gap-8 sm:gap-10">
                @yield('content')
            </div>
        </div>
    </main>
    @include('partials.main.footer')
</div>
</body>
</html>
