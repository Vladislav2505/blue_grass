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

<body class="bg-white h-full w-full">
<div class="flex flex-row-reverse justify-end">
    <div class="flex flex-col min-h-full w-full">
        @include('partials.admin.header')
        <main class="relative overflow-y-auto max-w-full h-fit mx-4 my-5 px-3 md:px-6 py-6 border-2">
            @yield('content')
        </main>
    </div>
{{--        <div class="fixed w-fit h-full flex flex-row">--}}
{{--            @include('partials.admin.sidebar')--}}
{{--        </div>--}}
</div>
</body>
</html>
