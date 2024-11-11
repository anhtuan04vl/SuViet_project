<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <link rel="icon" href="../img/Logo.png" type="image/png">
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <title>Sứ Việt - Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <!-- <link href="img/Logo.png" rel="icon"> -->

    <!-- Google Web Fonts Mảnope-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Gọi file admin.js chứa Bootstrap -->
    @vite('resources/js/admin.js') 
    @vite('resources/css/admin.css')

</head>
<body class="/bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Sidebar -->
        @include('admin.template.sidebar')

        <div class="content">
            <!-- Navbar -->
            @include('admin.template.navbar')

            <!-- Content -->
            <main class="flex-grow /p-6">
                @yield('content')
            </main>

            <!-- Footer -->
            @include('admin.template.footer')
        </div>
    </div>

    

    <!-- JavaScript Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>


    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script> -->

    
</body>
</html>
