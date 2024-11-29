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
                <a href="#" class="text-gray-700 hover:text-gray-900">Giỏ hàng</a>
            </li>
        </ol>
    </nav>
</div>
<!-- END BREADCRUMD -->
 
<div class="container-main">
    <!-- Main container -->
    <div class="container /mx-auto py-10 px-[5%] lg:px-0">
        
        <!-- Header title -->
        <div class="till flex flex-col gap-4 items-center mb-5">
            <h2 class="text-4xl font-bold text-center ">Liên hệ</h2>
            <p>Liên hệ ngay với chúng tôi để giải đáp mọi thắc mắc của bạn. </p>
        </div>
        
        <!-- Form container -->
        <div class="flex flex-col md:flex-row gap-10 items-center justify-center">
            
            <!-- Form -->
            <div class="w-full md:w-1/2 bg-white p-8 rounded-lg shadow-lg">
                <form action="#" method="POST">
                    
                    <!-- Full Name -->
                    <div class="mb-6">
                        <label for="fullName" class="block text-lg font-medium mb-2">Họ & Tên</label>
                        <input type="text" id="fullName" placeholder="Your Full Name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
                    
                    <!-- Email Address -->
                    <div class="mb-6">
                        <label for="email" class="block text-lg font-medium mb-2">Email</label>
                        <input type="email" id="email" placeholder="Your Email Address" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
                    
                    <!-- Reason/Purpose -->
                    <div class="mb-6">
                        <label for="reason" class="block text-lg font-medium mb-2">Địa chỉ</label>
                        <select id="reason" class="w-full px-4 py-3 border border-orange-300 text-gray-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400">
                            <option>-- Địa chỉ --</option>
                            <option>Investment Plan</option>
                            <option>Investment Plan 2</option>
                            <option>Investment Plan 3</option>
                        </select>
                    </div>

                    <!-- Message -->
                    <div class="mb-6">
                        <label for="message" class="block text-lg font-medium mb-2">Nội dung</label>
                        <textarea id="message" placeholder="Your Message" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
                    </div>
                    
                    <!-- Submit button -->
                    <button type="submit" class="w-full py-3 mt-4 bg-gradient-to-r from-cmain to-pink-500 text-white font-semibold rounded-lg hover:from-pink-500 hover:to-orange-400 focus:outline-none focus:ring-2 focus:ring-pink-300">Send Message</button>
                
                </form>
            </div>

            <!-- Image -->
            <div class="w-full md:w-1/2 flex justify-center">
                <img src="../img/sale_bn.webp" alt="Contact Icon" class="w-3/4 md:w-full max-w-sm rounded-lg shadow-lg">
            </div>

        </div>
    </div>
</div>
@endsection