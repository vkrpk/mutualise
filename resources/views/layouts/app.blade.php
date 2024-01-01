<!doctype html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <link rel="apple-touch-icon" sizes="180x180" href="{{ Vite::asset('resources/images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ Vite::asset('resources/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ Vite::asset('resources/images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ Vite::asset('resources/images/favicon/site.webmanifest') }}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    {{-- @stack('modalJs') --}}

    @yield('css')

</head>

<body>
    <x-header />
    <div style="height: 76px; width:100%"></div>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="pb-4">
        @yield('content')
    </div>
    <x-footer />

</body>
{!! GoogleReCaptchaV3::init() !!}
@stack('scripts')
</html>
