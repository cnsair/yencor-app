<!doctype html>

<html class="no-js" lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    
    <title>Rider - {{ Auth()->user()->firstname }}</title>

    <meta name="description" content="yencor - An AI-Powered Smart Public Transportation">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/assets/images/icon/yencor-favicon2.ico') }}">

    <x-css-links/>

    <!-- Livewire Styles -->
    @livewireStyles
</head>

<body class="theme-2">
    
    <x-dashboard-header/>

    @yield('content')
    
    <x-dashboard-footer/>

    <x-dashboard-js-script/>

    <!-- Livewire Scripts -->
    @livewireScripts

</body>

</html>