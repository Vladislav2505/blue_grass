<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{Vite::asset('resources/images/favicon.svg')}}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>{{config('app.name')}} - @yield('title')</title>

    <!-- Styles -->
    @vite(['resources/js/app.js'])
</head>
<body>
<main>
    @yield('content')
</main>
</body>
</html>