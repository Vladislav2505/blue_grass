<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('assets/img/favicon.svg')}}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>@yield('title')</title>

    <!-- Styles -->
    @vite('resources/css/app.css')
</head>

<body class="bg-lightpink">

@yield('content')

</body>
<script>
    document.getElementById('burger').addEventListener('click', function() {
        const mainDiv = document.getElementById('burger_menu');
        mainDiv.classList.toggle('hidden');
        mainDiv.classList.toggle('flex');
    });

    document.getElementById('burger_menu').addEventListener('click', function() {
        const mainDiv = document.getElementById('burger_menu');
        mainDiv.classList.toggle('hidden');
        mainDiv.classList.toggle('flex');
    });
</script>
</html>
