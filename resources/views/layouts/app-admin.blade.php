<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>{{ Auth()->user()->firstname }}</title>
    
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&callback=initMap" async defer></script>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"/>
    <meta name="description" content="yencor - A ride hailing App for everyone">
    <link rel="icon" href="{{ asset('assets/assets/images/icon/yencor-favicon2.ico') }}">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

    <!-- Main CSS -->
    <link href="{{ asset('assets/admin/css/main.07a59de7b920cd76b874.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/custom.css') }}" rel="stylesheet">

    <!-- FontType and Icons CSS -->
    <link type="text/css" href="{{ asset('assets/admin/icon-font-7-stroke/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/admin/icon-font-7-stroke/pe-icon-7-stroke/css/helper.css') }}" rel="stylesheet">

    <!-- Livewire Styles -->
    @livewireStyles
</head>

<body>
<div class="app-container app-theme-gray">
    <div class="app-main">

        @include('admin.sidebar')

        <div class="app-sidebar-overlay d-none animated fadeIn"></div>

        <div class="app-main__outer">
            <div class="app-main__inner">

                @include('admin.header')

                <div class="app-inner-layout app-inner-layout-page">

                    {{-- @include('admin.sub-header') --}}
                    
                    @yield('content')
                    
                </div>
            </div>

            @include('admin.footer')

        </div>
    </div>

</div>

{{-- @include('admin.server-components') --}}

<div class="app-drawer-overlay d-none animated fadeIn"></div>

<script type="text/javascript" src="{{ asset('assets/admin/scripts/main.07a59de7b920cd76b874.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
