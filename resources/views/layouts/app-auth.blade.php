<!doctype html>
<html class="no-js" lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>{{ config('app.name', 'yencor - Lets Go') }}</title>
    
    <meta name="description" content="yencor - An AI-Powered Smart Public Transportation">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/assets/images/icon/yencor-favicon2.ico') }}">
    
    <x-css-links></x-css-links>
</head>

<body class="striped-bg theme-3">
    <header class="theme-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/assets/images/logo/logo-one-1.png') }}" height="40" alt>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    @yield('content')
    
    <x-auth-footer></x-auth-footer>

    <x-js-scripts></x-js-scripts>
</body>

</html>