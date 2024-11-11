@extends('desktop.master')

@section('content')

     <!-- BREADCRUMD -->
     <div class="container-main py-5 px-[5%] lg:px-0">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="/inline-flex flex gap-2 items-center space-x-1">
                <li class="inline-flex items-center">
                    <a href="#" class="text-teal-500 hover:text-teal-700">Trang chủ</a>
                </li>
                <li>
                    <span class="flex w-1 h-1 bg-cmain rounded-full "></span>
                </li>
                <li>
                    <a href="#" class="text-gray-700 hover:text-gray-900">Sản phẩm chi tiết</a>
                </li>
            </ol>
        </nav>
    </div>
    <!-- END BREADCRUMD -->
<div class="container-main py-10 px-[5%] lg:px-0">
    <!-- Stats Section -->
    <div class="flex flex-wrap justify-center gap-10 lg:gap-20 p-10 bg-white rounded-lg shadow-md">
        <div class="text-center">
            <p class="text-2xl font-bold text-blue-500">100+</p>
            <p class="text-gray-500">Khách hàng đã đăng ký</p>
        </div>
        <div class="text-center">
            <p class="text-2xl font-bold text-blue-500">440M+</p>
            <p class="text-gray-500">Sản phẩm chạy hàng</p>
        </div>
        <div class="text-center">
            <p class="text-2xl font-bold text-blue-500">20+</p>
            <p class="text-gray-500">Đại lý nhượng quyền online</p>
        </div>
        <div class="text-center">
            <p class="text-2xl font-bold text-blue-500">+5</p>
            <p class="text-gray-500">Độ ngũ saler chất lượng</p>
        </div>
    </div>

    <!-- Heading Section -->
    <div class="text-center mt-10">
        <h2 class="text-3xl font-el font-bold ">Chúng tôi là Sứ Việt</h2>
        <p class="text-xl text-gray-600 my-5">LY’S mang một màu trắng ngà quý phái được các nghệ nhân lấy cảm hứng từ màu ngà voi trân quý, đón đầu một trào lưu, xu hướng mới trong nền công nghiệp dịch vụ ăn uống nói riêng và công nghiệp gốm sứ trên thế giới nói chung. </p>
    </div>

    <!-- Image Section -->
    <div class="flex justify-center gap-4 mt-10">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 /max-w-4xl">
            <img src="../img/about1.webp" alt="Image 1" class="rounded-lg shadow-md">
            <img src="../img/about1.webp" alt="Image 1" class="rounded-lg shadow-md">
            <img src="../img/about1.webp" alt="Image 1" class="rounded-lg shadow-md">
            <img src="../img/about1.webp" alt="Image 1" class="rounded-lg shadow-md">
        </div>
    </div>

    <!-- Core Values Section -->
    <div class="text-center mt-16">
        <h3 class="text-2xl font-semibold font-el">Mang lại những dịch vụ và sản phẩm chất lượng nhất đến tay khách hàng</h3>
        <button class="mt-4 px-4 py-2 bg-cmain text-white rounded-lg">Khám phá ngay</button>
    </div>

    <div class="grid grid-cols-5 gap-8   mt-10">
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <p class="text-xl font-bold text-cmain">01</p>
            <h4 class="font-semibold text-gray-800">Sản phẩm</h4>
            <p class="text-gray-500">Lorem ipsum dolor sit amet consectetur.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <p class="text-xl font-bold text-cmain">02</p>
            <h4 class="font-semibold text-gray-800">Nhân viên Tư vấn</h4>
            <p class="text-gray-500">Lorem ipsum dolor sit amet consectetur.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <p class="text-xl font-bold text-cmain">03</p>
            <h4 class="font-semibold text-gray-800">Bảo hành</h4>
            <p class="text-gray-500">Lorem ipsum dolor sit amet consectetur.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <p class="text-xl font-bold text-cmain">04</p>
            <h4 class="font-semibold text-gray-800">Vận chuyển</h4>
            <p class="text-gray-500">Lorem ipsum dolor sit amet consectetur.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <p class="text-xl font-bold text-cmain">05</p>
            <h4 class="font-semibold text-gray-800">Khuyến mãi</h4>
            <p class="text-gray-500">Lorem ipsum dolor sit amet consectetur.</p>
        </div>
    </div>

    <!-- Team Section -->
    <div class="container-main px-[5%] lg:px-0">
    <div class="text-center mt-16">
        <h3 class="text-2xl font-semibold">Đội ngũ phát triển</h3>
        <p class="text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
    </div>

    <div class="flex justify-center gap-8 my-8">
        <div class="text-center">
            <img src="../img/users.jpg" alt="Member 1" class="rounded-full shadow-md">
            <p class="font-semibold mt-4">Nguyễn Quốc Bảo</p>
            <p class="text-gray-500 text-sm">Co-Founder & COO</p>
        </div>
        <div class="text-center">
            <img src="../img/users.jpg" alt="Member 1" class="rounded-full shadow-md">
            <p class="font-semibold mt-4">Dương Minh Tú</p>
            <p class="text-gray-500 text-sm">Head of Infrastructure</p>
        </div>
        <div class="text-center">
            <img src="../img/users.jpg" alt="Member 1" class="rounded-full shadow-md">
            <p class="font-semibold mt-4">Nguyễn Quốc Linh</p>
            <p class="text-gray-500 text-sm">Head of Brand Marketing</p>
        </div>
        <div class="text-center">
            <img src="../img/users.jpg" alt="Member 1" class="rounded-full shadow-md">
            <p class="font-semibold mt-4">Nguyễn Quang Khải</p>
            <p class="text-gray-500 text-sm">Head of Brand Marketing</p>
        </div>
        <div class="text-center">
            <img src="../img/users.jpg" alt="Member 1" class="rounded-full shadow-md">
            <p class="font-semibold mt-4">Bùi Anh Tuấn</p>
            <p class="text-gray-500 text-sm">Head of Brand Marketing</p>
        </div>
    </div>
    </div>

</div>

@endsection