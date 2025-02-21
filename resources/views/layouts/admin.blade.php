<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body>

    <nav>
        <ul>
            <li><a href="{{ route('admin.testimonials') }}">Manage Testimonials</a></li>
        </ul>
    </nav>

    <div class="container">
        @yield('content')
    </div>

</body>
</html>
