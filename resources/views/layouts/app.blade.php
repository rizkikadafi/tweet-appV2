<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/sass/app.scss')
    @yield('styles')
    <title>Tweet App - @yield('title')</title>
</head>

<body>

    @yield('content')

    @vite('resources/js/app.js')
    {{-- @yield('scripts') --}}
    @stack('scripts')
</body>

</html>
