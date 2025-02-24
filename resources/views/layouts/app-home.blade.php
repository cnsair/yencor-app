<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ config('app.name', 'yencor - Lets Go') }}</title>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&callback=initMap" async defer></script>

    <meta name="description" content="yencor - An AI-Powered Smart Public Transportation">
    
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="robots" content="follow, download App" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/assets/images/icon/yencor-favicon2.ico') }}">

    <x-css-links/>

</head>

<body class="theme-1">
    <x-header-desktop-home></x-header-desktop-home>

    <x-header-mobile-home></x-header-mobile-home>

    @yield('content')

    <x-footer></x-footer>

    <x-js-scripts></x-js-scripts>
    
    @stack('scripts')

</body>

</html>
