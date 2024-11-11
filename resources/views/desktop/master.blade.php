<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/Logo.png" type="image/png">
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <title>Sứ Việt</title>
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
    <!-- link gg -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @stack('styles')

</head>
<body>
    
    <!-- menu -->
    @include('desktop.template.menu')
    <!-- slider -->
    @yield('slider')
    @yield('coupon')
    <!-- content -->
    @yield('content')
    <!-- Footer -->
    @include('desktop.template.footer')

@stack('scripts')
</body>

</html>