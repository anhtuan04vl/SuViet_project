@extends('desktop.master')

@section('content')
<!-- breadcrumb -->
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
                <a href="#" class="text-gray-700 hover:text-gray-900">Tài khoản</a>
            </li>
            <li>
                <span class="flex w-1 h-1 bg-cmain rounded-full "></span>
            </li>
            <li>
                <a href="#" class="text-gray-700 hover:text-gray-900">Đơn mua</a>
            </li>
        </ol>
    </nav>
</div>
<!-- end breadcrumb -->

<div class="container-main px-[5%] lg:px-0 ">
    <div class="flex  justify-between gap-5 py-10">
        <!-- Thanh bên trái -->
        <div class="w-1/4 bg-white p-4 shadow-md rounded-lg">
            <div class="flex items-center mb-6">
                <img src="../img/user.png" alt="">
                <div class="ml-4">
                    <h2 class="text-lg font-semibold">Tên người dùng</h2>
                    <a href="#" class="text-blue-500 text-sm">Sửa Hồ Sơ</a>
                </div>
            </div>
            <ul class="flex flex-col gap-5">
                <li><a href="#" class="flex items-center text-gray-700 hover:text-blue-500"><span class="mr-2">🔥</span>Ưu Đãi Dành Riêng Cho Bạn</a></li>
                <li><a href="#" class="flex items-center text-gray-700 hover:text-blue-500"><span class="mr-2">🎉</span>11.11 Sale Khủng Nhất Năm</a></li>
                <li><a href="#" class="flex items-center text-gray-700 hover:text-blue-500"><span class="mr-2">👤</span>Tài Khoản Của Tôi</a></li>
                <li><a href="#" class="flex items-center text-red-500 font-semibold"><span class="mr-2">📦</span>Đơn Mua</a></li>
                <li><a href="#" class="flex items-center text-gray-700 hover:text-blue-500"><span class="mr-2">🔔</span>Thông Báo</a></li>
                <li><a href="#" class="flex items-center text-gray-700 hover:text-blue-500"><span class="mr-2">🎟️</span>Kho Voucher</a></li>
            </ul>
        </div>

        <!-- Khu vực chính -->
        <div class="w-3/4 bg-white p-6 ml-6 shadow-md rounded-lg hidden">
            <!-- Thanh điều hướng tab -->
            <div class="border-b border-gray-200">
                <nav class="flex space-x-4">
                    <a href="#" class="text-gray-700 px-3 py-2 hover:text-blue-500">Tất cả</a>
                    <a href="#" class="text-gray-700 px-3 py-2 hover:text-blue-500">Chờ thanh toán</a>
                    <a href="#" class="text-gray-700 px-3 py-2 hover:text-blue-500">Vận chuyển</a>
                    <a href="#" class="text-gray-700 px-3 py-2 hover:text-blue-500">Chờ giao hàng</a>
                    <a href="#" class="text-gray-700 px-3 py-2 hover:text-blue-500">Hoàn thành</a>
                    <a href="#" class="text-gray-700 px-3 py-2 hover:text-blue-500">Đã hủy</a>
                    <a href="#" class="text-red-500 font-semibold px-3 py-2 border-b-2 border-red-500">Trả hàng/Hoàn tiền</a>
                </nav>
            </div>
            
            <!-- Nội dung chính -->
            <div class="flex flex-col items-center justify-center h-64">
                <img src="https://img.icons8.com/color/96/clipboard.png" alt="No orders" class="mb-4">
                <p class="text-gray-600 text-lg">Bạn hiện không có yêu cầu Trả hàng/Hoàn tiền nào</p>
            </div>

            
        </div>

        <!-- Khu vực hiển thị tài khoản -->
        <div class="w-3/4 bg-white p-6 ml-6 shadow-md rounded-lg  /hidden">
            <!-- Tiêu đề -->
            <h2 class="text-2xl font-semibold mb-6 text-center">Thông tin tài khoản</h2>
            
            <!-- Hiển thị thông tin tài khoản -->
            <form action="#" method="POST" class="space-y-4">
                <!-- Hình ảnh tài khoản -->
                <div class="flex flex-col items-center mb-6">
                    <img src="../img/user.png" alt="User profile picture" class="w-32 h-32 rounded-full mb-4 shadow-md" id="profile-image">
                    <p class="text-gray-600 text-sm">Ảnh đại diện của bạn</p>
                    <input type="file" name="profile_image" accept="image/*" class="mt-2 p-2 border border-gray-300 rounded-lg" onchange="previewImage(event)">
                </div>

                <div>
                    <label class="block text-gray-700">Tên người dùng</label>
                    <input type="text" name="username" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" placeholder="Tên người dùng của bạn" required>
                </div>

                <div>
                    <label class="block text-gray-700">Email</label>
                    <input type="email" name="email" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" placeholder="email@example.com" required>
                </div>

                <div>
                    <label class="block text-gray-700">Số điện thoại</label>
                    <input type="tel" name="phone" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" placeholder="0123456789" required>
                </div>

                <div>
                    <label class="block text-gray-700">Ngày đăng ký</label>
                    <input type="date" name="registration_date" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" required>
                </div>

                <div>
                    <label class="block text-gray-700">Ngày tháng năm sinh</label>
                    <input type="date" name="birth_date" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" required>
                </div>

                <div>
                    <label class="block text-gray-700">Giới tính</label>
                    <select name="gender" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" required>
                        <option value="">Chọn giới tính</option>
                        <option value="male">Nam</option>
                        <option value="female">Nữ</option>
                        <option value="other">Khác</option>
                    </select>
                </div>

                <!-- Nút để cập nhật thông tin tài khoản -->
                <button type="submit" class="inline-block bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Cập nhật thông tin</button>
            </form>
        </div>

        <!-- Khu vực chính -->
        <div class="w-3/4 bg-white p-6 ml-6 shadow-md rounded-lg hidden">
            <!-- Thanh điều hướng tab -->
            <div class="border-b border-gray-200">
                <nav class="flex space-x-4">
                    <a href="#" class="text-gray-700 px-3 py-2 hover:text-blue-500">Tất cả</a>
                    <a href="#" class="text-gray-700 px-3 py-2 hover:text-blue-500">Chờ thanh toán</a>
                    <a href="#" class="text-gray-700 px-3 py-2 hover:text-blue-500">Vận chuyển</a>
                    <a href="#" class="text-gray-700 px-3 py-2 hover:text-blue-500">Chờ giao hàng</a>
                    <a href="#" class="text-gray-700 px-3 py-2 hover:text-blue-500">Hoàn thành</a>
                    <a href="#" class="text-gray-700 px-3 py-2 hover:text-blue-500">Đã hủy</a>
                    <a href="#" class="text-red-500 font-semibold px-3 py-2 border-b-2 border-red-500">Trả hàng/Hoàn tiền</a>
                </nav>
            </div>
            
            <!-- Nội dung chính -->
            <div class="p-6">
                <!-- Thêm nội dung của đơn hàng đã hủy ở đây -->
                @for($i=0; $i<4; $i++)
                <div class="flex items-center gap-x-5 mb-5">
                    <img src="../img/chen1.png" alt="Product Image" class="w-20 h-20 mr-5">
                    <div>
                        <p class="font-semibold">Ag Matte Glass Case cho iPhone 15 14 13 12 11 Pro Max 14 15 Plus Bảo vệ toàn bộ ống kính</p>
                        <p class="text-gray-600">Phân loại hàng: Xanh đậm, iPhone 11Pro</p>
                        <p class="text-gray-600">Trả hàng miễn phí 15 ngày</p>
                    </div>
                </div>
                @endfor
               
                <!-- Thanh ti/DTD -->
                <div class="mt-10">
                    <p class="text-right font-semibold">Thành tiền: <span class="text-red-500">₫37.888</span></p>
                    <div class="flex justify-end space-x-4 mt-2">
                        <button class="bg-red-500 text-white px-4 py-2 rounded">Mua Lại</button>
                        <button class="border border-gray-300 text-gray-700 px-4 py-2 rounded">Xem Chi Tiết Hủy Đơn</button>
                        <button class="border border-gray-300 text-gray-700 px-4 py-2 rounded">Liên Hệ Người Bán</button>
                    </div>
                </div>
            </div>
        </div>



        <!-- end -->
    </div>
</div>

@endsection